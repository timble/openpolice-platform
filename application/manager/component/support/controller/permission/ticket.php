<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

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
