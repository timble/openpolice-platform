<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Streets;
use Nooku\Library;

class DatabaseTableLogs extends Library\DatabaseTableAbstract
{    
    public function  _initialize(Library\ObjectConfig $config)
    {        
        $config->append(array(
            'name'      => 'data.streets_logs',
            'behaviors' =>  array('creatable'),
            'filters'   => array('fields' => 'json'),
        ));
     
        parent::_initialize($config);
     }
}