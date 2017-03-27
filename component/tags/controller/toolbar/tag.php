<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Tags;

use Nooku\Library;

/**
 * Tag Controller Toolbar
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Nooku\Component\Tags
 */
class ControllerToolbarTag extends Library\ControllerToolbarActionbar
{    
    protected function _commandNew(Library\ControllerToolbarCommand $command)
    {
        $option = $this->getController()->getIdentifier()->package;
		$view	= Library\StringInflector::singularize($this->getIdentifier()->name);
		$table  = $this->getController()->getModel()->getState()->table;
		
        $command->href = 'option=com_'.$option.'&view='.$view.'&table='.$table;
    }
}