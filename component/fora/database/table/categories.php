<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Timble CVBA and Contributors. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git
 */

namespace Nooku\Component\Fora;
use Nooku\Library;


/**
 *  Categories Database Table
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser
 * @package Nooku\Component\Fora
 */
class DatabaseTableCategories extends Library\DatabaseTableAbstract
{
    public function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name'       => 'data.fora_categories',
            'behaviors'  => array(
                'creatable', 'modifiable', 'lockable', 'sluggable', 'com:categories.database.behavior.cascadable',
                'com:categories.database.behavior.nestable',
                'orderable'  => array('parent_column' => 'parent_id'),
                'com:attachments.database.behavior.attachable',
            ),
            'filters' => array(
                'description'   => array('html', 'tidy')
            )

        ));

        parent::_initialize($config);
    }
}