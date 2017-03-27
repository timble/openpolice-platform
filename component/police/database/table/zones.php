<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Police;
use Nooku\Library;

class DatabaseTableZones extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {        
        $config->append(array(
            'name'      => 'data.police_zones',
            'behaviors' =>  array('lockable', 'creatable', 'modifiable'),
            'filters' => array(
                'social'    => 'json'
            )
        ));
     
        parent::_initialize($config);
     }
}