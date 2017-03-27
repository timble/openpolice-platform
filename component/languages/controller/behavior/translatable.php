<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Languages;

use Nooku\Library;

/**
 * Translatable Controller Behavior
 *
 * @author  Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Nooku\Component\Languages
 */
class ControllerBehaviorTranslatable extends Library\DatabaseBehaviorAbstract
{
    protected function _beforeControllerRender(Library\CommandContext $context)
    {
        $model = $this->getModel();

        if($model->getTable()->isTranslatable())
        {
            $state = $model->getState();
            if(!isset($state->translated)) {
                $state->insert('translated', 'boolean');
            }
        }
    }
}