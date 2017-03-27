<?php
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Bin;
use Nooku\Library;

class DatabaseTableDistricts extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {        
        $config->append(array(
            'behaviors'    =>  array('sluggable', 'creatable', 'modifiable', 'lockable')
        ));
     
        parent::_initialize($config);
     }
}