<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class SupportDatabaseTableTickets extends Library\DatabaseTableAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors'  => array(
                'sluggable', 'creatable', 'modifiable', 'lockable',
                'com:comments.database.behavior.discussible',
                'com:attachments.database.behavior.attachable',
                'notifiable'
            ),
            'filters' => array(
                'text'   => array('html', 'tidy'),
            )
        ));

        parent::_initialize($config);
    }
}