<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;
use Nooku\Component\Attachments;

class AttachmentsControllerBehaviorAttachable extends Attachments\ControllerBehaviorAttachable
{
    protected function _beforeControllerAdd(Library\CommandContext $context)
    {
        return;
    }

    protected function _beforeControllerEdit(Library\CommandContext $context)
    {
        return;
    }

    protected function _afterControllerAdd(Library\CommandContext $context)
    {
        return;
    }

    protected function _afterControllerEdit(Library\CommandContext $context)
    {
        return;
    }

    protected function _afterControllerDelete(Library\CommandContext $context)
    {
        return;
    }
}
