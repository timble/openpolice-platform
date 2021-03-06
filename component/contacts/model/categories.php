<?php
/**
 * Belgian Police Web Platform - Contacts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Contacts;

use Nooku\Library;

class ModelCategories extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        // Set the state
        $this->getState()
            ->insert('parent'    , 'int')
            ->insert('published' , 'boolean')
            ->insert('distinct'  , 'string')
            ->insert('category'  , 'int')
            ->insert('sort'      , 'cmd', 'ordering')
            ->insert('hidden'    , 'boolean', true);
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        $state = $this->getState();

        //Exclude joins if counting records
        if(!$query->isCountQuery())
        {
            $query->columns(array('count'));

            $subquery = $this->getObject('lib:database.query.select')
                ->columns(array('contacts_category_id', 'count' => 'COUNT(contacts_category_id)'))
                ->table('contacts')
                ->group('contacts_category_id');

            $query->join(array('content' => $subquery), 'content.contacts_category_id = tbl.contacts_category_id');

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

        if (is_numeric($state->parent)) {
            $query->where('tbl.parent_id '.(is_array($state->parent) ? 'IN' : '=').' :parent')->bind(array('parent' => $state->parent));
        }

        if (is_numeric($state->category)) {
            $query->where('tbl.parent_id '.(is_array($state->category) ? 'IN' : '=').' :parent')->bind(array('parent' => $state->category));
        }

        if (is_bool($state->published))
        {
            $query->where('tbl.published = :published')->bind(array('published' => (int) $state->published));
        }

        if(is_bool($state->hidden)) {
            $query->where('tbl.hidden <= :hidden')->bind(array('hidden' => (int) $state->hidden));
        }
    }

    protected function _buildQueryGroup(Library\DatabaseQuerySelect $query)
    {
        $state = $this->getState();
        if( $state->distinct )
        {
            $query->distinct();
            $query->group($state->distinct);
        }
        else $query->group('tbl.contacts_category_id');
    }
}