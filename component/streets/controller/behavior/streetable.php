<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Streets;

use Nooku\Library;

/**
 * Streetable Controller Behavior
 */
class ControllerBehaviorStreetable extends Library\BehaviorAbstract
{
    protected function _saveRelations(Library\CommandContext $context)
    {
        if ($context->error) {
            return;
        }

        $row   = $context->result;
        $table = $row->getTable()->getBase();

        // Remove all existing relations
        if($row->id && $row->getTable()->getBase())
        {
            $rows = $this->getObject('com:traffic.model.streets')
                ->article($row->id)
                ->getRowset();

            $rows->delete();
        }

        if($row->streets)
        {
            // Save streets as relations
            foreach ($row->streets as $street)
            {
                $relation = $this->getObject('com:traffic.database.row.street');
                $relation->streets_street_id = $street;
                $relation->traffic_article_id = $row->id;

                if(!$relation->load()) {
                    $relation->save();
                }
            }
        }

        return true;
    }

    protected function _afterControllerAdd(Library\CommandContext $context)
    {
        $this->_saveRelations($context);
    }

    protected function _afterControllerEdit(Library\CommandContext $context)
    {
        $this->_saveRelations($context);
    }
}