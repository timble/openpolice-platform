<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Support;

use Nooku\Library;
use Nooku\Component\Comments;

class DatabaseTableComments extends Comments\DatabaseTableComments
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors'  => array(
                'com:attachments.database.behavior.attachable',
                'notifiable'
            )
        ));

        parent::_initialize($config);
    }
}