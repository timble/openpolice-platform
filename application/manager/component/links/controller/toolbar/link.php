<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Links;

use Nooku\Library;

class ControllerToolbarLink extends Library\ControllerToolbarActionbar
{
    protected function _afterControllerBrowse(Library\CommandContext $context)
    {
        $this->addBootup();
        $this->addCrawl();
    }

    protected function _commandBootup(Library\ControllerToolbarCommand $command)
    {
        $command->append(array(
            'attribs' => array(
                'data-novalidate' => 'novalidate',
                'data-action'     => 'bootup'
            )
        ));
    }

    protected function _commandCrawl(Library\ControllerToolbarCommand $command)
    {
        $command->append(array(
            'attribs' => array(
                'data-novalidate' => 'novalidate',
                'data-action'     => 'crawl'
            )
        ));
    }
}