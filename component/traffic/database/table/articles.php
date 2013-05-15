<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

namespace Nooku\Component\Traffic;
use Nooku\Library;

class DatabaseTableArticles extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {        
        $config->append(array(
            'name'         => 'traffic',
            'behaviors'    =>  array('sluggable', 'lockable', 'creatable', 'modifiable'),
            'filters' => array(
                'text'   => array('html', 'tidy')
            )
        ));
     
        parent::_initialize($config);
     }
}