<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Pages;

use Nooku\Library;

/**
 * Closurable Controller Behavior
 *
 * @author  Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Nooku\Component\Pages
 */
class ControllerBehaviorClosurable extends Library\DatabaseBehaviorAbstract
{
    protected function _beforeControllerGet(Library\CommandContext $context)
    {
        $model = $this->getModel();
        if($model->getTable()->isClosurable())
        {
            $state = $model->getState();
            
            if(!isset($state->parent)) {
                $state->insert('parent', 'int');
            }
            
            if(!isset($state->level)) {
                $state->insert('level', 'int');
            }
        }
    }
}