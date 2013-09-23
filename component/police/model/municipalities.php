<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Police;
use Nooku\Library;

class ModelMunicipalities extends Library\ModelTable
{	
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('zone' , 'int')
            ->insert('parent_id' , 'int');
	}
    
    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);
	
		$query->columns(array(
			'city_title'  => 'municipality.title',
            'city_postcode'  => 'municipality.postcode',
            'zone_title'  => 'zone.title',
		));
	}
	
	protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
	{
		$query->join(array('municipality' => 'police_municipalities'), 'tbl.parent_id = municipality.police_municipality_id');
        $query->join(array('zone' => 'police_zones'), 'tbl.police_zone_id = zone.police_zone_id');
	}
	
    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('tbl.title LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
		}
        
		if ($state->zone) {
			$query->where('tbl.police_zone_id = :zone')->bind(array('zone' => $state->zone));
		}
        
        if (is_numeric($state->parent_id)) {        
            $query->where('tbl.parent_id = :parent_id')->bind(array('parent_id' => $state->parent_id));
		}
	}
}