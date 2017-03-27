<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class StreetsModelStreets extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('city' , 'int')
            ->insert('no_islp' , 'int')
            ->insert('title' , 'string')
            ->insert('sort' , 'cmd', 'title');
    }

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);
        $state = $this->getState();

        $cities = $this->getObject('com:police.model.zones')->id($this->getObject('application')->getSite())->getRow()->cities;

        $query->columns(array(
            'title'             => $cities !== '1' ? "CONCAT(tbl.title,' (',city.title,')')" : 'tbl.title',
            'title_short'       => 'tbl.title',
            'city'              => 'city.title',
            'islp'              => 'islps.islp'
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        $state = $this->getState();

        $languages = $this->getObject('application.languages');
        $language = $languages->getActive()->slug;

        // Join the ISLP ID
        $query->join(array('islps' => 'data.streets_streets_islps'), 'islps.streets_street_identifier = tbl.streets_street_identifier');

        $query->join(array('city' => $language == 'fr' ? 'data.fr-be_streets_cities' : 'data.streets_cities'), 'city.streets_city_id = tbl.streets_city_id');

        parent::_buildQueryJoins($query);
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        $site = $this->getObject('application')->getSite();

        if ($state->search) {
            $query->where('(tbl.title LIKE :search OR islps.islp LIKE :search OR tbl.streets_street_id LIKE :search)')->bind(array('search' => '%' . $state->search . '%'));
        }

        if ($state->city) {
            $query->where('tbl.streets_city_id = :city')->bind(array('city' => $state->city));
        }

        if ($state->no_islp) {
            $query->where('islps.islp IS NULL');
        }
    }
}