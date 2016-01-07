<?php
/**
 * Belgian Police Web Platform - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Forms;
use Nooku\Library;

class DatabaseTableForms extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name'         => 'forms',
            'behaviors'    =>  array(
                'sluggable', 'creatable', 'modifiable', 'lockable',
            ),
            'filters' => array(
                'text'   => array('html', 'tidy')
            )
        ));

        parent::_initialize($config);
    }
}