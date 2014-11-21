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

class ModelStreets extends Library\ModelTable
{	
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('city' , 'int')
            ->insert('islp' , 'string')
            ->insert('no_islp' , 'int')
            ->insert('no_district' , 'int')
            ->insert('district' , 'int')
            ->insert('sort'      , 'cmd', 'title');
	}

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);
        $state = $this->getState();

        $query->columns(array(
            'title' => "CONCAT(tbl.title, ' (', city.title, ')')",
            'district_count' => 'content.district_count'
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        $state = $this->getState();

        $query->join(array('city' => 'data.streets_cities'), 'city.streets_city_id = tbl.streets_city_id');

        $subquery = $this->getObject('lib:database.query.select')
            ->columns(array('streets_street_id', 'district_count' => 'COUNT(DISTINCT districts_district_id)'))
            ->table('districts_relations')
            ->group('streets_street_id');

        $query->join(array('content' => $subquery), 'content.streets_street_id = tbl.streets_street_id');


        parent::_buildQueryJoins($query);
    }
	
    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('(tbl.title LIKE :search OR tbl.islp LIKE :search OR tbl.streets_street_id LIKE :search)')->bind(array('search' => '%'.$state->search.'%'));
		}

        if ($state->title) {
            $query->where('tbl.title LIKE :title')->bind(array('title' => $state->title));
        }

        if ($state->city) {
            $query->where('tbl.streets_city_id = :city')->bind(array('city' => $state->city));
        }

        // com:uploads uses ISLP column to find a street
        if ($state->islp) {
            $query->where('tbl.islp = :islp')->bind(array('islp' => $state->islp));
        }

        if ($state->no_islp) {
            $query->where('tbl.islp IS NULL');
        }

        if ($state->no_district == '1') {
            $query->where('content.district_count IS NULL');
        }

        if ($state->district == '1') {
            $query->where('content.district_count IS NOT NULL');
        }

        if($this->getObject('application')->getSite() != 'default') {
            $query->where('city.police_zone_id = :zone')->bind(array('zone' => $this->getObject('application')->getSite()));
        }
	}
}