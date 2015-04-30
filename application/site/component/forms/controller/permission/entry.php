<?php
/**
 * Belgian Police Web Platform - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class FormsControllerPermissionEntry extends ApplicationControllerPermissionAbstract
{
    public function canAdd()
    {
        return true;
    }

    public function canBrowse()
    {
        return false;
    }

    public function canRead()
    {
        return false;
    }
}