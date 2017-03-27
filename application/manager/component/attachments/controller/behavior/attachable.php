<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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
