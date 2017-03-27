<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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
