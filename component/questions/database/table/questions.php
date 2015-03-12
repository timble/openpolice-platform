<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Questions;
use Nooku\Library;

class DatabaseTableQuestions extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {        
        $config->append(array(
            'name'         => 'questions',
            'behaviors'    =>  array(
                'sluggable', 'creatable', 'modifiable', 'lockable',
                'com:attachments.database.behavior.attachable',
                'com:languages.database.behavior.translatable'
            ),
          	'filters' => array(
          	    'text'   => array('html', 'tidy'),
                'params'      => 'json'
          	)
        ));
     
        parent::_initialize($config);
     }
}