<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

abstract class ApplicationControllerPermissionAbstract extends Library\ControllerPermissionAbstract
{
    public function canRender()
    {
        if(parent::canRender() && $this->getUser()->getRole() > 24) {
            return true;
        }

        return false;
    }

    public function canRead()
    {
        if(parent::canRead() && $this->getUser()->getRole() > 24) {
            return true;
        }

        return false;
    }

    public function canBrowse()
    {
        if(parent::canBrowse() && $this->getUser()->getRole() > 24) {
            return true;
        }

        return false;
    }

    public function canAdd()
    {
        if(parent::canAdd() && $this->getUser()->getRole() > 24) {
            return true;
        }

        return false;
    }

    public function canEdit()
    {
        if(parent::canEdit() && $this->getUser()->getRole() > 24) {
            return true;
        }

        return false;
    }

    public function canDelete()
    {
        if(parent::canDelete() && $this->getUser()->getRole() > 24) {
            return true;
        }

        return false;
    }
}
