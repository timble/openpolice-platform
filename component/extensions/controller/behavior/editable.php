<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Extensions;

use Nooku\Library;

/**
 * Editable Controller Behavior
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Extensions
 */
class ControllerBehaviorEditable extends Library\ControllerBehaviorEditable
{  
    public function __construct(Library\ObjectConfig $config)
    { 
        parent::__construct($config);
        
        $this->registerCallback('before.browse' , array($this, 'setReferrer'));
    }

    public function canSave()
    {
        return $this->canEdit();
    }
    
	protected function _actionSave(Library\CommandContext $context)
	{
		$entity = $context->getSubject()->execute('edit', $context);
	    
		$context->response->setRedirect($this->getReferrer($context));
		return $entity;
	}
    
	protected function _actionCancel(Library\CommandContext $context)
	{
        $context->response->setRedirect($this->getReferrer($context));
		return;
	}

	protected function _actionApply(Library\CommandContext $context)
	{
		$entity = $context->getSubject()->execute('edit', $context);

        $context->response->setRedirect($context->request->getUrl());
		return $entity;
	}
}