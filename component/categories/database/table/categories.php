<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Categories;

use Nooku\Library;

/**
 * Categories Database Table
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Categories
 */
class DatabaseTableCategories extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name'       => 'categories',
            'behaviors'  => array(
            	'creatable', 'modifiable', 'lockable', 'sluggable', 'cascadable', 'nestable',
            	'orderable'  => array('parent_column' => 'parent_id'),
                'com:attachments.database.behavior.attachable',
                'com:languages.database.behavior.translatable'
            ),
            'filters' => array(
                'description'   => array('html', 'tidy')
            )
            ));

        parent::_initialize($config);
    }
}
