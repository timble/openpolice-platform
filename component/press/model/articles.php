<?php
/**
 * Belgian Police Web Platform - Press Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Press;
use Nooku\Library;

class ModelArticles extends Library\ModelTable
{
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('published' , 'int')
			->insert('sort'      , 'cmd', 'ordering_date')
			->insert('direction' , 'cmd', 'DESC');
	}

	protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);

		$query->columns(array(
			'ordering_date'     => 'IF(tbl.published_on, tbl.published_on, tbl.publish_on)',
			'draft'             => 'IF(tbl.published_on OR tbl.publish_on, 0, 1)'
		));
	}
	
	protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
	    parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('tbl.title LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
		}
		
		if (is_numeric($state->published)) {
			$query->where('tbl.published = :published')->bind(array('published' => $state->published));
		}
	}

	protected function _buildQueryOrder(Library\DatabaseQuerySelect $query)
	{
		$state = $this->getState();

		if ($state->sort == 'ordering_date')
		{
			$query->order('draft', $state->direction)
				->order('ordering_date', $state->direction);
		} else {
			$query->order($state->sort, strtoupper($state->direction));
		}
	}
}