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
 * Http Dispatcher
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Users
 */
class UsersDispatcherHttp extends Library\DispatcherHttp
{
    protected function _actionDispatch(Library\CommandContext $context)
	{        	
        if($context->user->isAuthentic())
        {  
            //Redirect if user is already logged in
            if($context->request->query->get('view', 'alpha') == 'session')
            {
                $menu = $this->getObject('application.pages')->getHome();
                //@TODO : Fix the redirect
                //$this->getObject('application')->redirect('?Itemid='.$menu->id, 'You are already logged in!');
            }
        }

        if(!$context->user->isAuthentic())
        {  
            //Redirect if user is already logged in
            if($context->request->query->get('view', 'alpha') == 'session')
            {
                $menu = $this->getObject('application.pages')->getHome();
                //@TODO : Fix the redirect
                //$this->getObject('application')->redirect('?Itemid='.$menu->id, 'You are already logged out!');
            }
        } 
               
        return parent::_actionDispatch($context);
	}
}