<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

namespace Nooku\Component\Districts;
use Nooku\Library;

class ModelRelations extends Library\ModelTable
{
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('district' , 'int')
		    ->insert('street' , 'string');
	}

	protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);

		$query->columns(array(
			'street'    => 'street.title',
		));
	}

	protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
	{
		$query->join(array('street_relation' => 'streets_relations'), 'street_relation.table = :table AND street_relation.row = tbl.districts_relation_id')->bind(array('table' => 'districts_relations'))
              ->join(array('street' => 'streets'), 'street.streets_street_id = street_relation.streets_street_id');
	}

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('street.title LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
		}

		if ($state->district) {
			$query->where('tbl.districts_district_id = :district')->bind(array('district' => (int) $state->district));
		}

		if ($state->street) {
            if(is_numeric($state->street)){
                $query->where('street.streets_street_id = :street')->bind(array('street' => (int) $state->street));
            }

            if(!is_numeric($state->street)){
                $query->where('street.title LIKE :street')->bind(array('street' => '%'.$state->street.'%'));
            }
		}
	}

    protected function _buildQueryOrder(Library\DatabaseQuerySelect $query)
    {
        $state = $this->getState();

        $direction = strtoupper($state->direction);
        $query->order('street', $direction)
              ->order('range_start', $direction);

    }
}