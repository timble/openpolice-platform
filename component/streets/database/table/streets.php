<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Streets;
use Nooku\Library;

class DatabaseTableStreets extends Library\DatabaseTableAbstract
{    
    public function  _initialize(Library\ObjectConfig $config)
    {        
        $config->append(array(
            'name'      => 'streets',
            'behaviors' =>  array(
                'lockable', 'creatable', 'modifiable', 'sluggable'
            )
        ));
     
        parent::_initialize($config);
     }
}