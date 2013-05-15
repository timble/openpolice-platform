<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Timble CVBA and Contributors. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git
 */

namespace Nooku\Component\Pages;

use Nooku\Library;

/**
 * Menu Controller Toolbar
 *
 * @author  Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Nooku\Component\Pages
 */
class ControllerToolbarMenu extends Library\ControllerToolbarModel
{
    protected function _commandNew(Library\ControllerToolbarCommand $command)
    {
        $application = $this->getController()->getModel()->application;
        $command->href = 'option=com_pages&view=menu&application='.$application;
    }
}
