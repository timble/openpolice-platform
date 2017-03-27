<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\About;

use Nooku\Library;

class DatabaseBehaviorDeletable extends Library\DatabaseBehaviorAbstract
{
    protected function _beforeTableDelete(Library\CommandContext $context)
    {
        $identifier = 'com:about.database.table.articles';

        $rowset = $this->getObject($identifier)->select(array('about_category_id' => $this->id));

        //Prevent the item from being deleted
        if($rowset->count()) {
            return false;
        }

        return true;
    }
}