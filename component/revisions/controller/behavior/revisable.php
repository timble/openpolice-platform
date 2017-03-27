<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Revisions;

use Nooku\Library;

/**
 * Revisable Controller Behavior
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Revisions
 */
class ControllerBehaviorRevisable extends Library\ControllerBehaviorAbstract
{
    protected function _beforeControllerBrowse(Library\CommandContext $context)
	{
        $state = $context->getSubject()->getModel()->getState();

        //If we are filtering for all the trashed entities, decorate the actionbar with the revisable toolbar
        if($state->trashed == true && $this->hasToolbar('actionbar')) {
            $this->getToolbar('actionbar')->decorate('com:revisions.controller.toolbar.revisable');
        }
	}
}