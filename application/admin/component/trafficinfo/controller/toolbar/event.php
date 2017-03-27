<?php
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class ComTrafficinfoControllerToolbarEvent extends ComDefaultControllerToolbarDefault
{
    protected function _afterControllerBrowse(Library\CommandContext $context)
    {
        parent::_afterControllerBrowse($context);

        $this->reset();
        $this->addJam();
        $this->addWorkers();
        $this->addGhost();
        $this->addActua();
        $this->addDensity();
        $this->addSeparator();
        $this->addDelete();
        $this->addSeparator();
        $this->addEnable(array('label' => 'publish'));
        $this->addDisable(array('label' => 'unpublish'));
    }
    
    protected function _commandJam(KControllerToolbarCommand $command)
    {
        $command->label = JText::_('Jam');
        $command->href = 'option=com_trafficinfo&view=event&category=1';
    }
    
    protected function _commandWorkers(KControllerToolbarCommand $command)
    {
        $command->label = JText::_('Workers');
        $command->href = 'option=com_trafficinfo&view=event&category=2';
    }
    
    protected function _commandGhost(KControllerToolbarCommand $command)
    {
        $command->label = JText::_('Ghost');
        $command->href = 'option=com_trafficinfo&view=event&category=3';
    }
    
    protected function _commandActua(KControllerToolbarCommand $command)
    {
        $command->label = JText::_('Actua');
        $command->href = 'option=com_trafficinfo&view=event&category=5';
    }
    
    protected function _commandDensity(KControllerToolbarCommand $command)
    {
        $command->label = JText::_('Density');
        $command->href = 'option=com_trafficinfo&view=event&category=4';
    }
}