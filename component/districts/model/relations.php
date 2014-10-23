<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Districts;
use Nooku\Library;

class ModelRelations extends Library\ModelTable
{
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('district' , 'string')
		    ->insert('street' , 'string', '0')
		    ->insert('number' , 'string', '0')
		    ->insert('no_street' , 'int');
	}

	protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);

		$query->columns(array(
			'street' 	=> "CONCAT(street.title, ' (', city.title, ')')",
            'district'  => 'district.title'
        ));
	}

	protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
	{
		$query->join(array('street' => 'data.streets'), 'street.streets_street_id = tbl.streets_street_id')
			  ->join(array('city' => 'data.streets_cities'), 'city.streets_city_id = street.streets_city_id')
              ->join(array('district' => 'districts'), 'district.districts_district_id = tbl.districts_district_id');
	}

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->district) {
			$query->where('tbl.districts_district_id = :district')->bind(array('district' => $state->district));
		}

		if ($state->street) {
            if(is_numeric($state->street)){
                $query->where('street.streets_street_id = :street')->bind(array('street' => $state->street));
            }

            if(!is_numeric($state->street)){
                $query->where('street.title LIKE :street')->bind(array('street' => '%'.$state->street.'%'));
            }

            if(is_numeric($state->number)) {
                $query->where('tbl.range_start <= :range_start')->bind(array('range_start' => $state->number));
                $query->where('tbl.range_end >= :range_end')->bind(array('range_end' => $state->number));

                $parity = ($state->number % 2 == 0) ? 'even' : 'odd';
                $query->where('tbl.range_parity LIKE :range_parity')->bind(array('range_parity' => '%'.$parity.'%'));
            }
		}

        if ($state->no_street) {
            $query->where('tbl.streets_street_id IS NULL');
        }

        if ($state->search) {
            $query->where('street.title LIKE :search OR tbl.islp LIKE :search ')->bind(array('search' => '%'.$state->search.'%'));
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
