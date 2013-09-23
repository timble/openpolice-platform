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

class ModelCities extends Library\ModelTable
{	
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
            ->insert('parent_id' , 'int');
	}
	
    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('tbl.title LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
		}
              
        $query->where('tbl.parent_id = :parent_id')->bind(array('parent_id' => '0'));
	}
}