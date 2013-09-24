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

class ModelRelations extends Library\ModelTable
{	
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('street' , 'string')
		    ->insert('row' , 'int')
		    ->insert('table' , 'string', $this->getIdentifier()->package);
	}
	
	protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);
	
		$query->columns(array(
			'street'    => 'street.title'
		));
	}
	
	protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
	{
		$query->join(array('street' => 'streets'), 'street.streets_street_id = tbl.streets_street_id');
	}
	
    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryWhere($query);
		$state = $this->getState();
		
		if ($state->street) {
			$query->where('tbl.streets_street_id = :street')->bind(array('street' => $state->street));
		}
		
		if ($state->row) {
			$query->where('tbl.row = :row')->bind(array('row' => (int) $state->row));
		}
		
		if ($state->table) {
			$query->where('tbl.table = :table')->bind(array('table' => $state->table));
		}
	}
}