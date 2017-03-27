<?php
/**
 * Belgian Police Web Platform - Announcements Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Announcements;

use Nooku\Library;

class DatabaseRowsetAnnouncements extends Library\DatabaseRowsetAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'identity_column' => 'identifier'
        ));

        parent::_initialize($config);
    }
}
