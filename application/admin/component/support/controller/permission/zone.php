<?php
use Nooku\Library;

class SupportControllerPermissionZone extends ApplicationControllerPermissionAbstract
{
    public function canAdd()
    {
        return false;
    }

    public function canEdit()
    {
        if(parent::canEdit() && $this->getUser()->getRole() == 25) {
            return true;
        }

        return false;
    }

    public function canDelete()
    {
        return false;
    }
}