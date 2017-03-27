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

class ModelRelations extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        // Set the state
        $this->getState()
            ->insert('row'  , 'int')
            ->insert('table', 'string', $this->getIdentifier()->package);
    }

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);

        $query->columns(array(
            'title'   => 'streets.title',
            'slug'    => 'streets.slug'
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);

        $query->join(array('streets' => 'data.streets'), 'streets.streets_street_identifier = tbl.streets_street_identifier');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        $state = $this->getState();

        if(!$this->getState()->isUnique())
        {
            if($this->getState()->table) {
                $query->where('tbl.table = :table')->bind(array('table' => $this->getState()->table));
            }

            if($this->getState()->row) {
                $query->where('tbl.row IN :row')->bind(array('row' => (array) $this->getState()->row));
            }
        }

        parent::_buildQueryWhere($query);
    }
}