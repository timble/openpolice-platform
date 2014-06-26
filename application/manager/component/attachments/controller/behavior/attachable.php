<?php
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