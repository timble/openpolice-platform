<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Traffic;
use Nooku\Library;

class DatabaseTableArticles extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {        
        $config->append(array(
            'name'         => 'traffic',
            'behaviors'    =>  array(
                'sluggable', 'creatable', 'modifiable', 'lockable',
                'com:streets.database.behavior.locatable',
                'com:languages.database.behavior.translatable',
                'com:attachments.database.behavior.attachable'
            ),
            'filters' => array(
                'text'   => array('html', 'tidy')
            )
        ));
     
        parent::_initialize($config);
     }
}