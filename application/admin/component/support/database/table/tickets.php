<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class SupportDatabaseTableTickets extends Library\DatabaseTableAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors'  => array(
                'creatable', 'modifiable', 'lockable', 'sluggable',
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