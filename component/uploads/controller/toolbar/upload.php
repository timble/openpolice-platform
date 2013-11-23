<?php
/**
 * Belgian Police Web Platform - Uploads Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Uploads;

use Nooku\Library;

/**
 * Article Controller Actionbar
 *
 * @author  Johan Janssens <http://nooku.assembla.com/profile/johanjanssens>
 * @package Nooku\Component\Articles
 */
class ControllerToolbarUpload extends Library\ControllerToolbarActionbar
{
    protected function _afterControllerBrowse(Library\CommandContext $context)
    {
        parent::_afterControllerBrowse($context);

        $this->reset();
        $this->addDistricts();
        $this->addRelations();
        $this->addStreets();
        $this->addNews();
    }

    protected function _commandDistricts(Library\ControllerToolbarCommand $command)
    {
        $command->label = 'Districts';
        $command->href = 'option=com_uploads&view=upload&table=districts';
    }

    protected function _commandRelations(Library\ControllerToolbarCommand $command)
    {
        $command->label = 'Districts - Streets';
        $command->href = 'option=com_uploads&view=upload&table=districts_relations';
    }

    protected function _commandStreets(Library\ControllerToolbarCommand $command)
    {
        $command->label = 'Local Streets';
        $command->href = 'option=com_uploads&view=upload&table=agiv_streets';
    }

    protected function _commandNews(Library\ControllerToolbarCommand $command)
    {
        $command->label = 'News';
        $command->href = 'option=com_uploads&view=upload&table=news';
    }
}