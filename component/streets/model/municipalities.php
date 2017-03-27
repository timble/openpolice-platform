<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Streets;
use Nooku\Library;

class ModelMunicipalities extends Library\ModelTable
{
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('zone' , 'int')
			->insert('municipality', 'string')
			->insert('language', 'string')
            ->insert('parent_id' , 'int');
	}

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);

		$query->columns(array(
			'city_title'  => 'city.title',
			'police_zone_id'  => 'city.police_zone_id',
			'title' => "IF(tbl.parent_id, CONCAT(tbl.title,' (',parent.title,')'), tbl.title)"
		));
	}

	protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
	{
		$languages = $this->getObject('application.languages');
		$language = $languages->getActive()->slug;

		$query->join(array('city' => $language == 'fr' ? 'data.fr-be_streets_cities' : 'data.streets_cities'), 'city.streets_city_id = tbl.streets_city_id')
			  ->join(array('parent' => 'data.streets_municipalities'), '(parent.streets_municipality_id = tbl.parent_id AND parent.language = tbl.language)');
	}

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryWhere($query);
		$state = $this->getState();

		if (!is_numeric($state->search)) {
			$query->where('tbl.title LIKE :search')->bind(array('search' => '%'.trim($state->search).'%'));
		} else {
			$query->where('tbl.postcode = :search')->bind(array('search' => trim($state->search)));
		}

		if($state->municipality){
			$query->where('tbl.streets_municipality_id = :municipality')->bind(array('municipality' => $state->municipality));
		}

		if($state->language){
			$query->where('tbl.language = :language')->bind(array('language' => $state->language));
		}

		if ($state->zone) {
			$query->where('city.police_zone_id = :zone')->bind(array('zone' => $state->zone));
		}

        if (is_numeric($state->parent_id)) {
            $query->where('tbl.parent_id = :parent_id')->bind(array('parent_id' => $state->parent_id));
		}
	}
}