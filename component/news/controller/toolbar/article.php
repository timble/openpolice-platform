<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\News;
use Nooku\Library;

class ControllerToolbarArticle extends Library\ControllerToolbarActionbar
{
    protected function _afterControllerBrowse(Library\CommandContext $command)
    {
        parent::_afterControllerBrowse($command);

        $this->addSeparator();
        $this->addEnable(array('label' => 'publish', 'attribs' => array('data-data' => '{published:1}')));
        $this->addDisable(array('label' => 'unpublish', 'attribs' => array('data-data' => '{published:0}')));
        $this->addSeparator();
        $this->addStickify();
        $this->addUnstickify();
    }

    protected function _commandStickify(Library\ControllerToolbarCommand $command)
    {
        $command->label = \JText::_('Set Sticky');

        $command->append(array(
            'attribs' => array(
                'data-action' => 'edit',
                'data-data'   => '{sticky:1}'
            )
        ));
    }

    protected function _commandUnstickify(Library\ControllerToolbarCommand $command)
    {
        $command->label = \JText::_('Remove Sticky');

        $command->append(array(
            'attribs' => array(
                'data-action' => 'edit',
                'data-data'   => '{sticky:0}'
            )
        ));
    }
}
