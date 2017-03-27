<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Questions;
use Nooku\Library;

class ModelQuestions extends Library\ModelTable
{
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('published' , 'int')
			->insert('published_category' , 'int')
            ->insert('category' , 'string')
            ->insert('sort', 'cmd', 'title')
            ->insert('searchword', 'string');
	}

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);

        $query->join(array('categories'  => 'questions_categories'), 'categories.questions_category_id = tbl.questions_category_id');
    }
	
	protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
	    parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('tbl.title LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
		}

        if ($state->searchword) {
            $words = explode(' ', $state->searchword);

            foreach($words AS $word) {
                $query->where('(tbl.title LIKE :search OR tbl.text LIKE :search)')->bind(array('search' => '%' . $word . '%'));
            }
        }
		
		if (is_numeric($state->published)) {
			$query->where('tbl.published = :published')->bind(array('published' => $state->published));
		}

		if (is_numeric($state->published_category)) {
			$query->where('categories.published = :published')->bind(array('published' => $state->published_category));
		}

        if(!is_numeric($state->category) && !is_null($state->category)) {
            $query->where('categories.slug = :category')->bind(array('category' => $state->category));
        }

        if (is_numeric($state->category)) {
            $query->where('tbl.questions_category_id = :category')->bind(array('category' => $state->category));
        }
	}
}
