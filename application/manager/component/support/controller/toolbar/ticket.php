<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class SupportControllerToolbarTicket extends Library\ControllerToolbarActionbar
{
    /**
     * @param Library\CommandContext $context
     */
    protected function _afterControllerBrowse(\Nooku\Library\CommandContext $command)
    {

    }

    protected function _afterControllerRead(\Nooku\Library\CommandContext $command)
    {
        if($this->getController()->getView()->getLayout() == 'default')
        {
            $this->addBack();

            if($this->getController()->canEdit())
            {
                $this->addSeparator();
                $this->addEdit();
            }
        }
    }

    protected function _commandBack(Library\ControllerToolbarCommand $command)
    {
        $command->label = \JText::_('Back');
        $command->href = 'option=com_support&view=tickets';
    }
}
