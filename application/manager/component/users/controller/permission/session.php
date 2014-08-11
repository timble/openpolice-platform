<?php
use Nooku\Library;

class SessionControllerPermissionSession extends ApplicationControllerPermissionAbstract
{
    public function canRender()
    {
        return $this->canRead();
    }

    public function canRead()
    {
        if(!$this->getUser()->isAuthentic()) {
            return true;
        }

        return false;
    }

    public function canBrowse()
    {
        return false;
    }

    public function canAdd()
    {
        return true;
    }

    public function canEdit()
    {
        return false;
    }

    public function canDelete()
    {
        //Allow logging out ourselves
        if($this->getModel()->getState()->id == $this->getUser()->getSession()->getId()) {
            return true;
        }

        // Only administrator can logout other users
        if($this->getUser()->getRole() > 24) {
            return true;
        }

        return false;
    }
}