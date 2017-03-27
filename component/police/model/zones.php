<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Police;
use Nooku\Library;

class ModelZones extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('platform' , 'int')
            ->insert('language' , 'int')
            ->insert('province' , 'int')
            ->insert('district' , 'int');
    }

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);

        $query->columns(array(
            'cities' => 'COUNT(city.police_zone_id)',
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        $languages = $this->getObject('application.languages');
        $language = $languages->getActive()->slug;

        $query->join(array('city' => $language == 'fr' ? 'data.fr-be_streets_cities' : 'data.streets_cities'), 'city.police_zone_id = tbl.police_zone_id');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('tbl.titles LIKE :search OR tbl.police_zone_id LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
		}

        if (is_numeric($state->platform)) {
            $query->where('tbl.platform = :platform')->bind(array('platform' => $state->platform));
        }

        if (is_numeric($state->language)) {
            $query->where('tbl.language = :language')->bind(array('language' => $state->language));
        }

        if (is_numeric($state->province)) {
            $query->where('city.streets_province_id = :province')->bind(array('province' => $state->province));
        }

        if (is_numeric($state->district)) {
            $query->where('city.streets_district_id = :district')->bind(array('district' => $state->district));
        }
	}

    protected function _buildQueryGroup(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryGroup($query);

        $query->group('tbl.police_zone_id');
    }
}