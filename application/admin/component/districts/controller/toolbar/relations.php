<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */


use Nooku\Library;

class DistrictsControllerToolbarRelations extends Library\ControllerToolbarAbstract
{
    public function getCommands()
    {
        $this->reset()
        	->addDelete();

        return parent::getCommands();
    }
}