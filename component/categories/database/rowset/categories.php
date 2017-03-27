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
 * Categories Database Rowset
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Categories
 */
class DatabaseRowsetCategories extends DatabaseRowsetNodes
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'status'          => Library\Database::STATUS_LOADED,
            'identity_column' => 'id'
        ));

        parent::_initialize($config);
    }
}