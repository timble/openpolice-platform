<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Item Controller
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Cache
 */
class CacheControllerItem extends Library\ControllerModel
{ 
    protected function _actionPurge(Library\CommandContext $context)
    {
        //Purge the cache
        if(JFactory::getCache('')->gc()) {
            $message = JText::_( 'Expired items have been purged' );
        } else {
           $message = JText::_('Error purging expired items');
        }

        $context->response->setRedirect($context->request-getUrl(), $message);
        return true;
    }
    
	public function getRequest()
	{
		$request = parent::getRequest();
		
	    //Force the site
	    //$request->site = $this->getObject('application')->getSite();
	    
	    return $request;
	}
}