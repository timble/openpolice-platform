<?php
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Found;

use Nooku\Library;

class ModelCategories extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        // Set the state
        $this->getState()
            ->insert('published' , 'boolean')
            ->insert('category'  , 'int')
            ->insert('sort'      , 'cmd', 'title');
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        $state = $this->getState();

        //Exclude joins if counting records
        if(!$query->isCountQuery())
        {
            $query->columns(array('count'));

            $subquery = $this->getObject('lib:database.query.select')
                ->columns(array('found_category_id', 'count' => 'COUNT(found_category_id)'))
                ->table('found')
                ->group('found_category_id');

            $query->join(array('content' => $subquery), 'content.found_category_id = tbl.found_category_id');

        }

        parent::_buildQueryJoins($query);
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);

        $state = $this->getState();

        if($state->search) {
            $query->where('tbl.title LIKE %:search%')->bind(array('search' => $state->search));
        }

        if (is_numeric($state->category))
        {
            $query->where('tbl.found_category_id = :category')->bind(array('category' => $state->category));
        }

        if (is_bool($state->published))
        {
            $query->where('tbl.published = :published')->bind(array('published' => (int) $state->published));
        }
    }
}