<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

namespace Nooku\Component\Streets;

use Nooku\Library;

/**
 * Streetable Database Behavior
 */
class DatabaseBehaviorStreetable extends Library\DatabaseBehaviorAbstract
{
    /**
     * Get a list of streets
     *
     * @return DatabaseRowsetStreets
     */
    public function getStreets()
    {
        $model = $this->getObject('com:streets.model.relations');

        if(!$this->isNew())
        {
            $streets = $model->row($this->id)
                ->table($this->getTable()->getName())
                ->getRowset();
        }
        else $streets = $model->getRowset();

        return $streets;
    }

    /**
     * Modify the select query
     *
     * If the query's where information includes a street propery, auto-join the streets tables with the query and select
     * all the rows that have a street.
     */
    protected function _beforeTableSelect(Library\CommandContext $context)
    {
        $query = $context->query;

        if(!is_null($query))
        {
            foreach($query->where as $key => $where)
            {
                if($where['condition'] == 'tbl.street')
                {
                    $table = $context->caller;

                    $query->where('streets.slug', $where['constraint'],  $where['value']);
                    $query->where('streets_relations.table','=', $table->getName());
                    $query->join('LEFT', 'streets_relations AS streets_relations', 'streets_relations.row = tbl.'.$table->getIdentityColumn());
                    $query->join('LEFT', 'streets AS streets', 'streets.streets_street_id = streets_relations.streets_street_id');

                    unset($context->query->where[$key]);
                }
            }
        }
    }
}