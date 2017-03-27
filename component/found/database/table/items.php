<?php
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Found;
use Nooku\Library;

class DatabaseTableItems extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name'         => 'found',
            'behaviors'    =>  array(
                'sluggable', 'lockable', 'creatable', 'modifiable',
                'com:attachments.database.behavior.attachable',
                'com:languages.database.behavior.translatable',
                'com:streets.database.behavior.locatable'
            ),
            'filters' => array(
                'text'   => array('html', 'tidy')
            )
        ));

        parent::_initialize($config);
    }
}