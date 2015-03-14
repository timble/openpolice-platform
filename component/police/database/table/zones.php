<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
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