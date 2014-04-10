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
            ->insert('islp' , 'int');
	}

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);

        $query->columns(array(
            'title' => "CONCAT(tbl.title, ' (', city.title, ')')"
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        $query->join(array('city' => 'data.streets_cities'), 'city.streets_city_id = tbl.streets_city_id');
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

        if ($state->islp) {
            $query->where('tbl.islp = :islp')->bind(array('islp' => $state->islp));
        }

        if ($state->islp === 0) {
            $query->where('tbl.islp IS NULL');
        }

        $query->where('city.police_zone_id = :zone')->bind(array('zone' => $this->getObject('application')->getSite()));
	}
}