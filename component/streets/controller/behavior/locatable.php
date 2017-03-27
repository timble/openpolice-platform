<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Streets;

use Nooku\Library;

/**
 * Locatable Controller Behavior
 */
class ControllerBehaviorLocatable extends Library\BehaviorAbstract
{
    protected function _saveRelations(Library\CommandContext $context)
    {
        if ($context->error) {
            return;
        }

        $row   = $context->result;
        $table = $row->getTable()->getBase();

        // Remove all existing relations
        if($row->id && $table)
        {
            $streets = $this->getObject('com:streets.model.relations')
                ->row($row->id)
                ->table($table)
                ->getRowset();

            foreach ($streets as $street)
            {
                $relation = $this->getObject('com:streets.database.row.relation');
                $relation->streets_street_identifier    = $street->streets_street_identifier;
                $relation->row                          = $street->row;
                $relation->table                        = $street->table;

                if($relation->load()) {
                    $relation->delete();
                }
            }
        }

        if($row->streets)
        {
            // Force array
            $streets = (array) $row->streets;

            // Save streets as relations
            foreach ($streets as $street)
            {
                $relation = $this->getObject('com:streets.database.row.relation');
                $relation->streets_street_identifier    = $street;
                $relation->row                          = $row->id;
                $relation->table                        = $table;

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

    protected function _afterControllerDelete(Library\CommandContext $context)
    {
        $status = $context->result->getStatus();

        if($status == Library\Database::STATUS_DELETED || $status == 'trashed')
        {
            $id = $context->result->get('id');
            $table = $context->result->getTable()->getBase();

            if(!empty($id) && $id != 0)
            {
                $rows = $this->getObject('com:streets.model.relations')
                    ->row($id)
                    ->table($table)
                    ->getRowset();

                $rows->delete();
            }
        }
    }
}