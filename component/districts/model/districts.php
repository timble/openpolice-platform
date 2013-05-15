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

class ModelDistricts extends Library\ModelTable
{
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
            ->insert('number' , 'int')
            ->insert('street' , 'int');
	}

	protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);

		$query->columns(array(
			'contact'    => 'contact.name'
		));
	}

	protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
	{
		$query->join(array('contact' => 'contacts'), 'contact.contacts_contact_id = tbl.contacts_contact_id');
        $query->join(array('relation' => 'districts_relations'), 'tbl.districts_district_id = relation.districts_district_id');
        $query->join(array('street_relation' => 'streets_relations'), 'street_relation.table = :table AND street_relation.row = relation.districts_relation_id')->bind(array('table' => 'districts_relations'));
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('tbl.title LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
		}

        if($state->street && $state->number) {

            $query->where('street_relation.streets_street_id = :street')->bind(array('street' => (int) $state->street));

            $query->where('relation.range_start <= :range_start')->bind(array('range_start' => (int) $state->number));
            $query->where('relation.range_end >= :range_end')->bind(array('range_end' => (int) $state->number));

            $parity = ($state->number % 2 == 0) ? 'even' : 'odd';
            $query->where('relation.range_parity LIKE :range_parity')->bind(array('range_parity' => '%'.$parity.'%'));

            parent::_buildQueryWhere($query);
        }
	}
}