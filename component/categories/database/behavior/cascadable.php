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
 * Cascadable Database Behavior
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Categories
 */
class DatabaseBehaviorCascadable extends Library\DatabaseBehaviorAbstract
{
    protected function _beforeTableDelete(Library\CommandContext $context)
    {
        $result = true;

        $table      = $this->table;
        $identifier = 'com:'.$table.'.database.table.'.$table;

        $rowset = $this->getObject($identifier)->select(array('categories_category_id' => $this->id));

        if($rowset->count()) {
            $result = $rowset->delete();
        }

        return $result;
    }
}