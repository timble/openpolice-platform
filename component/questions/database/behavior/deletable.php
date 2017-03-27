<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Questions;

use Nooku\Library;

class DatabaseBehaviorDeletable extends Library\DatabaseBehaviorAbstract
{
    protected function _beforeTableDelete(Library\CommandContext $context)
    {
        $identifier = 'com:questions.database.table.questions';

        $rowset = $this->getObject($identifier)->select(array('questions_category_id' => $this->id));

        //Prevent the item from being deleted
        if($rowset->count()) {
            return false;
        }

        return true;
    }
}