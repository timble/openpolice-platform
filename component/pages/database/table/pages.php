<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Pages;

use Nooku\Library;

/**
 * Pages Database Table
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Pages
 */
class DatabaseTablePages extends Library\DatabaseTableAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name' => 'pages',
            'behaviors'  => array(
                'creatable', /*'modifiable',*/ 'lockable', 'sluggable', 'assignable', 'typable',
                'com:pages.database.behavior.orderable' => array(
                    'strategy' => 'closure',
                    'table'    => 'com:pages.database.table.orderings',
                    'columns'  => array('title', 'custom')
                ),
                'com:pages.database.behavior.closurable' => array(
                    'table' => 'com:pages.database.table.closures'
                ),
                'com:languages.database.behavior.translatable'
            ),
            'filters' => array(
                'params' => 'ini'
            )
        ));

        parent::_initialize($config);
    }
}
