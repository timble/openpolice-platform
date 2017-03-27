<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Traffic;

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
            ->insert('sort'      , 'cmd', 'title');
    }

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);

        $query->columns(array(
            'thumbnail'         => 'attachments.path'
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        $state = $this->getState();

        $query->join(array('attachments'  => 'attachments'), 'attachments.attachments_attachment_id = tbl.attachments_attachment_id');

        //Exclude joins if counting records
        if(!$query->isCountQuery())
        {
            $query->columns(array('count'));

            $subquery = $this->getObject('lib:database.query.select')
                ->columns(array('traffic_category_id', 'count' => 'COUNT(traffic_category_id)'))
                ->table('traffic')
                ->group('traffic_category_id');

            $query->join(array('content' => $subquery), 'content.traffic_category_id = tbl.traffic_category_id');

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
    }

    protected function _buildQueryGroup(Library\DatabaseQuerySelect $query)
    {
        $state = $this->getState();
        if( $state->distinct )
        {
            $query->distinct();
            $query->group($state->distinct);
        }
        else $query->group('tbl.traffic_category_id');
    }
}