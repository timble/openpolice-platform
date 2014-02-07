<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;

/**
 * Ticket Controller Toolbar
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Support
 */
class SupportControllerToolbarTicket extends Library\ControllerToolbarActionbar
{
    /**
     * @param Library\CommandContext $context
     */
    protected function _afterControllerBrowse(\Nooku\Library\CommandContext $command)
    {
        if($this->getController()->canAdd())
        {
            $this->addIssue();
        }

        if($this->getController()->canDelete())
        {
            $this->addSeparator();
            $this->addDelete();
        }
    }

    protected function _afterControllerRead(\Nooku\Library\CommandContext $command)
    {
        if($this->getController()->getView()->getLayout() == 'default')
        {
            $this->addBack();
            $this->addEdit();
            $this->addSeparator();
        } else parent::_afterControllerRead($command);
    }

    protected function _commandBack(Library\ControllerToolbarCommand $command)
    {
        $command->label = \JText::_('Back');
        $command->href = 'option=com_support&view=tickets';
    }

    protected function _commandEdit(Library\ControllerToolbarCommand $command)
    {
        $id = $this->getController()->getModel()->getRow()->id;

        $command->label = \JText::_('Edit');
        $command->href = 'option=com_support&view=ticket&layout=form&id='.$id;
    }

    protected function _commandIssue(Library\ControllerToolbarCommand $command)
    {
        $command->label = \JText::_('New');
        $command->href = 'option=com_support&view=ticket&layout=form';
    }
}