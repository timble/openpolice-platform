<?php
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Trafficinfo;
use Nooku\Library;

class ModelEvents extends Library\ModelTable
{
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('category' , 'int')
		    ->insert('place' , 'int');
	}
	
	protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);
	
		$query->columns(array(
			'category'    		=> 'category.title',
			'incident'    		=> 'incident.title',
			'place'    		    => 'place.title',
			'place_direction'   => 'place_direction.title',
			'place_end'    		=> 'place_end.title',
			'road'    		    => 'road.title',
			'road_bis'    		=> 'road_bis.title',
			'situation'    		=> 'situation.title',
			'source'    		=> 'source.title',
			'traffic'    	    => 'traffic.title',
			'last_activity_on'  => 'IF(tbl.modified_on, tbl.modified_on, tbl.created_on)',
			'last_activity_by'  => 'IF(tbl.modified_by, modifier.name, creator.name)'
		));
	}
	
	protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
	{
		$query->join(array('category' => 'trafficinfo_categories'), 'category.trafficinfo_category_id = tbl.trafficinfo_category_id');
		
		$query->join(array('incident' => 'trafficinfo_items'), 'incident.trafficinfo_item_id = tbl.trafficinfo_item_id_incident');
		$query->join(array('place' => 'trafficinfo_items'), 'place.trafficinfo_item_id = tbl.trafficinfo_item_id_place');
		$query->join(array('place_direction' => 'trafficinfo_items'), 'place_direction.trafficinfo_item_id = tbl.trafficinfo_item_id_place_direction');
		$query->join(array('place_end' => 'trafficinfo_items'), 'place_end.trafficinfo_item_id = tbl.trafficinfo_item_id_place_end');
		$query->join(array('road' => 'trafficinfo_items'), 'road.trafficinfo_item_id = tbl.trafficinfo_item_id_road');
		$query->join(array('road_bis' => 'trafficinfo_items'), 'road_bis.trafficinfo_item_id = tbl.trafficinfo_item_id_road_bis');
		$query->join(array('situation' => 'trafficinfo_items'), 'situation.trafficinfo_item_id = tbl.trafficinfo_item_id_situation');
		$query->join(array('source' => 'trafficinfo_items'), 'source.trafficinfo_item_id = tbl.trafficinfo_item_id_source');
		$query->join(array('traffic' => 'trafficinfo_items'), 'traffic.trafficinfo_item_id = tbl.trafficinfo_item_id_traffic');
		
		$query->join(array('creator' => 'users'), 'creator.users_user_id = tbl.created_by');
		$query->join(array('modifier' => 'users'), 'modifier.users_user_id = tbl.modified_by');
	}
	
	protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
	    parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('tbl.road LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
		}
		
		if (is_bool($state->published)) {
			$query->where('tbl.published = :published')->bind(array('published' => (int) $state->published));
		}
		
		if ($state->place) {
			$query->where('tbl.trafficinfo_item_id_place = :place')->bind(array('place' => (int) $state->place));
		}
		
	    if ($state->category) {
			$query->where('tbl.trafficinfo_category_id = :category')->bind(array('category' => (int) $state->category));
		}
	}
}