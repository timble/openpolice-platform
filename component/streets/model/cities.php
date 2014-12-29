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

class ModelCities extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('zone' , 'int');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        if ($state->search) {
            $query->where('tbl.title LIKE :search OR tbl.streets_city_id LIKE :search OR tbl.police_zone_id LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
        }

        if(!in_array($this->getObject('application')->getSite(), array('default', '5904'))) {
            $query->where('tbl.police_zone_id = :zone')->bind(array('zone' => $this->getObject('application')->getSite()));
        }

        if ($this->getObject('application')->getSite() == '5904') {
            $query->where('tbl.police_zone_id IN :zone')->bind(array('zone' => array('5904', '5430', '5431')));
        }
    }
}