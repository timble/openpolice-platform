<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\About;
use Nooku\Library;

class DatabaseTableArticles extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name'         => 'about',
            'behaviors'    =>  array(
                'sluggable', 'creatable', 'modifiable', 'lockable',
                'com:attachments.database.behavior.attachable',
                'com:languages.database.behavior.translatable',
                'orderable' => array(
                    'strategy' => 'flat'
                ),
            ),
            'filters' => array(
                'introtext'   => array('html', 'tidy'),
                'fulltext'    => array('html', 'tidy'),
                'params'      => 'json'
            )
        ));

        parent::_initialize($config);
    }
}