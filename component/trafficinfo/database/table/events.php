<?php
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Trafficinfo;
use Nooku\Library;

class DatabaseTableEvents extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {        
        $config->append(array(
            'behaviors'    =>  array('lockable', 'creatable', 'modifiable'),
          	'filters' => array(
             	'text'      => array('html', 'tidy'),
             	'densities' => array('json'),
             	'information' 	    => array('json')
              )
        ));
     
        parent::_initialize($config);
     }
}