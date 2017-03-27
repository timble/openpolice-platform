<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class UsersControllerSession extends Library\ControllerModel
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        //Only authenticate POST requests
        $this->registerCallback('before.add' , array($this, 'authenticate'));

        //Lock the referrer to prevent it from being overridden for read requests
        if ($this->isDispatched() && !$this->getRequest()->isAjax())
        {
            if($this->isEditable()) {
                $this->registerCallback('after.delete' , array($this, 'lockReferrer'));
            }
        }
    }

    public function authenticate(Library\CommandContext $context)
    {
        //Load the user
        $user = $this->getObject('com:users.model.users')->email($context->request->data->get('email', 'email'))->getRow();

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
            else throw new Library\ControllerExceptionUnauthorized('Wrong email');

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

    protected function _actionAdd(Library\CommandContext $context)
    {
        //Start the session (if not started already)
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
            'application' => 'manager',
            'name'        => $context->user->getName()
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
        //Force logout from site and administrator
        $context->request->query->application = array('site', 'admin', 'manager');

        //Remove the session from the session store
        $entity = parent::_actionDelete($context);

        if(!$context->response->isError())
        {
            // Destroy the php session for this user if we are logging out ourselves
            if($context->user->getEmail() == $entity->email) {
                $context->user->session->destroy();
            }
        }

        //Redirect to caller
        $context->response->setRedirect($context->request->getReferrer());

        return $entity;
    }
}
