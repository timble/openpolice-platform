<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Session Controller
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Users
 */
class UsersControllerSession extends Library\ControllerModel
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        //Only authenticate POST requests
        $this->registerCallback('before.add' , array($this, 'authenticate'));

        $this->registerCallback('after.add'  , array($this, 'redirect'));
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors' => array(
                'com:activities.controller.behavior.loggable' => array('title_column' => 'name')
            )
        ));

        parent::_initialize($config);
    }

    public function authenticate(Library\CommandContext $context)
    {
        //Load the user
        $user = $this->getObject('com:users.model.users')
            ->email($context->request->data->get('email', 'email'))
            ->getRow();

        //Load parameters
        $params = $this->getObject('application.extensions')->users->params;

        $max_login_attempts = (int) $params->get('maximum_login_attempts', 5);
        $lockout_time       = (int) $params->get('lockout_time', 900);

        if(!$user->isNew())
        {
            //Authenticate the user
            if($user->id)
            {
                $locked_out = ($user->login_attempts >= $max_login_attempts);

                if ($locked_out)
                {
                    $expired = (strtotime(gmdate('Y-m-d H:i:s')) - strtotime($user->last_login_attempt) < $lockout_time);

                    if ($expired) {
                        throw new Library\ControllerExceptionUnauthorized('You have been temporarily locked out');
                    }

                    //Reset the attempt count as soon as lock-out expires to prevent being immediately locked out again
                    $user->login_attempts = 0;
                }

                $password = $user->getPassword();

                if(!$password->verify($context->request->data->get('password', 'string')))
                {
                    //Count login attempts
                    $user->setData(array(
                        'login_attempts'     => $user->login_attempts + 1,
                        'last_login_attempt' => gmdate('Y-m-d H:i:s')
                    ));

                    $user->save();

                    if ($user->login_attempts >= $max_login_attempts) {
                        $message = 'Too many failed login attempts. You have been temporarily locked out of your account';
                    }
                    else $message = 'Wrong password';

                    throw new Library\ControllerExceptionUnauthorized($message);
                }
            }

            //Check if user is enabled
            if (!$user->enabled) {
                throw new Library\ControllerExceptionUnauthorized('Account disabled');
            }

            //Start the session (if not started already)
            $context->user->session->start();

            //Set user data in context
            $context->user->values($user->getSessionData(true));
        }
        else throw new Library\ControllerExceptionUnauthorized('Wrong email');

        //Reset login attempts on successful authentication
        $user->setData(array(
            'login_attempts'     => 0,
            'last_login_attempt' => ''
        ));

        $user->save();

        return true;
    }

    public function redirect(Library\CommandContext $context)
    {
        if ($context->result !== false)
        {
            $user     = $context->user;
            $password = $this->getObject('com:users.database.row.password')->set('id', $user->getEmail())->load();

            if ($password->expired())
            {
                $extension = $this->getObject('application.extensions')->getExtension('users');
                $pages     = $this->getObject('application.pages');

                $page = $pages->find(array(
                    'extensions_extension_id' => $extension->id,
                    'link'                    => array(array('view' => 'user'))));

                $url                  = $page->getLink();
                $url->query['layout'] = 'password';
                $url->query['id']     = $user->getId();

                $this->getObject('application')->getRouter()->build($url);
                $this->getObject('application')->redirect($url);
            }
        }
    }

    protected function _actionAdd(Library\CommandContext $context)
    {
        $session = $context->user->session;

        //Insert the session into the database
        if(!$session->isActive()) {
            throw new Library\ControllerExceptionActionFailed('Session could not be stored. No active session');
        }

        //Fork the session to prevent session fixation issues
        $session->fork();

        //Prepare the data
        $data = array(
            'id'          => $session->getId(),
            'guest'       => !$context->user->isAuthentic(),
            'email'       => $context->user->getEmail(),
            'data'        => '',
            'time'        => time(),
            'application' => 'site',
        );

        $context->request->data->add($data);

        //Store the session
        $entity = parent::_actionAdd($context);

        //Set the session data
        $session->site = $this->getObject('application')->getSite();

        //Redirect to caller
        $context->response->setRedirect($context->request->getReferrer());

        return $entity;
    }

    protected function _actionDelete(Library\CommandContext $context)
    {
        //Force logout from site only
        $context->request->query->application = array('site');

        //Remove the session from the session store
        $entity = parent::_actionDelete($context);

        if(!$context->response->isError())
        {
            // Destroy the php session for this user if we are logging out ourselves
            if($context->user->getEmail() == $entity->email) {
                $context->user->session->destroy();
            }
        }

        return $entity;
    }
}