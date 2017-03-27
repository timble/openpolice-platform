<?php
/**
 * Belgian Police Web Platform - Press Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Press;
use Nooku\Library;

class DatabaseTableArticles extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {        
        $config->append(array(
            'name'         => 'press',
            'behaviors'    =>  array(
                'sluggable', 'creatable', 'modifiable', 'lockable',
                'com:attachments.database.behavior.attachable',
                'com:languages.database.behavior.translatable',
                'com:news.database.behavior.publishable' => array('table' => 'press')
            ),
          	'filters' => array(
          	    'text'   => array('html', 'tidy'),
          	)
        ));
     
        parent::_initialize($config);
     }
}