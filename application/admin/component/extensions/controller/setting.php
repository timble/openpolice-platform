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
 * Setting Controller
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Extensions
 */
class ExtensionsControllerSetting extends Library\ControllerModel
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors' => array('editable'),
            'request'   => array('view' => 'settings')
        ));

        parent::_initialize($config);
    }

    protected function _actionRead(Library\CommandContext $context)
    {
        $name = ucfirst($this->getView()->getName());

        if(!$this->getModel()->getState()->isUnique()) {
            throw new Library\ControllerExceptionNotFound($name.' Not Found');
        }

        return parent::_actionRead($context);
    }
}