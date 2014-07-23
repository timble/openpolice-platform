<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\News;
use Nooku\Library;

class DatabaseTableArticles extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {        
        $config->append(array(
            'name'         => 'news',
            'behaviors'    =>  array(
                'sluggable', 'lockable', 'creatable', 'modifiable', 'stickable',
                'com:attachments.database.behavior.attachable',
                'com:languages.database.behavior.translatable'
            ),
          	'filters' => array(
          	    'introtext'   => array('html', 'tidy'),
          	    'fulltext'    => array('html', 'tidy'),
          	)
        ));
     
        parent::_initialize($config);
     }
}