<?php
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Bin;
use Nooku\Library;

class DatabaseTableRelations extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {        
        $config->append(array(
               'behaviors' =>  array('lockable', 'creatable', 'modifiable', 'com:streets.database.behavior.streetable')
           ));
        
           parent::_initialize($config);
     }
}