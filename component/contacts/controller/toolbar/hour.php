<?php
/**
 * Belgian Police Web Platform - Contacts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Contacts;

use Nooku\Library;

class ControllerToolbarHour extends Library\ControllerToolbarActionbar
{
    protected function _afterControllerBrowse(Library\CommandContext $context)
    {
        parent::_afterControllerBrowse($context);


    }

    protected function _commandNew(Library\ControllerToolbarCommand $command)
    {
        $contact  = $this->getController()->getModel()->getState()->contact;
        $command->href .= '&contact='.$contact;
    }
}