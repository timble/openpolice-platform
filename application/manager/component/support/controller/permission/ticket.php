<?php
use Nooku\Library;

class SupportControllerPermissionTicket extends ApplicationControllerPermissionAbstract
{
    public function canAdd()
    {
        return false;
    }

    public function canEdit()
    {
        return false;
    }

    public function canDelete()
    {
        return false;
    }
}