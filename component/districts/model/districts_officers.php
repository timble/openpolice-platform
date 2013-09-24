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

class ModelDistricts_officers extends Library\ModelTable
{
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('district' , 'string')
		    ->insert('officer' , 'int');
	}
	
	protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);
	
		$query->columns(array(
            'name'      => "CONCAT(officer.firstname, ' ', officer.lastname)",
            'firstname' => 'officer.firstname',
			'lastname'  => 'officer.lastname',
			'district'  => 'district.title'
		));
	}
	
	protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
	{
		$query->join(array('officer' => 'districts_officers'), 'officer.districts_officer_id = tbl.districts_officer_id');
		$query->join(array('district' => 'districts'), 'district.districts_district_id = tbl.districts_district_id');
	}
	
    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryWhere($query);
		$state = $this->getState();
		
		if ($state->district) {
			$query->where('tbl.districts_district_id = :district')->bind(array('district' => $state->district));
		}
		
		if ($state->officer) {
			$query->where('tbl.districts_officer_id = :officer')->bind(array('officer' => (int) $state->officer));
		}
	}
}