<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Traffic;
use Nooku\Library;

class ModelArticles extends Library\ModelTable
{
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('published' , 'int')
            ->insert('category' , 'string')
            ->insert('type' , 'string')
		    ->insert('date' , 'string')
            ->insert('results' , 'boolean');
	}

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);
        $state = $this->getState();

        $query->join(array('categories'  => 'traffic_categories'), 'categories.traffic_category_id = tbl.traffic_category_id');
    }
	
	protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
	    parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('tbl.title LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
		}

        if(!is_numeric($state->category) && !is_null($state->category)) {
            $query->where('categories.slug = :category')->bind(array('category' => $state->category));
        }

        if(is_numeric($state->category)) {
            $query->where('tbl.traffic_category_id = :category')->bind(array('category' => $state->category));
        }
		
		if (is_numeric($state->published)) {
			$query->where('tbl.published = :published')->bind(array('published' => $state->published));
		}

		if ($state->date == 'past') {
			$query->where('tbl.end_on < :past')->bind(array('past' => date('Y-m-d')));
		}

		if ($state->date == 'upcoming') {
            $query->where('(tbl.end_on >= :today OR tbl.end_on IS NULL)')->bind(array('today' => date('Y-m-d')));
		}

        if ($state->results) {
            $query->where('(tbl.controlled > 0 AND tbl.in_violation >= 0)');
            $query->where('tbl.end_on < :past')->bind(array('past' => date('Y-m-d')));
        }
	}
}
