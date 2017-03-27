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
 * Http Dispatcher
 *
 * @author  Ercan Ozkaya <http://nooku.assembla.com/profile/ercanozkaya>
 * @package Component\Files
 */
class FilesDispatcherHttp extends Library\DispatcherHttp
{
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);
	
		// Return JSON response when possible
		$this->registerCallback('after.post' , array($this, 'renderResponse'));

        // Return correct status code for plupload
        $this->getObject('application')->registerCallback('before.send', array($this, 'setStatusForPlupload'));
	}

    protected function _actionGet(Library\CommandContext $context)
    {
        $controller = $this->getController();

        if($controller instanceof Library\ControllerModellable)
        {
            if(!$controller->getModel()->getState()->isUnique())
            {
                $limit = $controller->getModel()->getState()->limit;

                //If limit is empty use default, except for the folders controller (allow 0).
                if($controller->getIdentifier()->name != 'folder' && empty($limit)) {
                    $limit = $this->getConfig()->limit->default;
                }

                //Force the maximum limit
                if($limit > $this->getConfig()->limit->max) {
                    $limit = $this->getConfig()->limit->max;
                }

                $controller->getModel()->getState()->limit = $limit;
            }
        }

        return $controller->execute('render', $context);
    }
	
	public function renderResponse(Library\CommandContext $context)
	{
		if ($context->action !== 'delete' && $this->getRequest()->getFormat() === 'json') {
			$this->getController()->execute('render', $context);
		}
	}

    /**
     * Return 200 even if an error happens in requests using Plupload. Otherwise we cannot get the error message and
     * display it to the user interface
     */
    public function setStatusForPlupload(Library\CommandContext $context)
    {
        if ($context->request->getFormat() == 'json' && $context->request->query->get('plupload', 'int')) {
            $context->response->setStatus('200');
        }
    }
}