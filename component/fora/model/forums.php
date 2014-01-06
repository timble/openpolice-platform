<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

namespace Nooku\Component\Fora;

use Nooku\Library;

/**
 * Forums Model
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Nooku\Component\Fora
 */
class ModelForums extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('category'  , 'slug')
            ->insert('published' , 'int')
            ->insert('searchword', 'string');

        $this->getState()->remove('sort')->insert('sort', 'cmd', 'ordering');
    }
    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);

        $query->columns(array(
            'category_title'         => 'categories.title',
            'last_activity_on'       => 'IF(tbl.modified_on, tbl.modified_on, tbl.created_on)',
            'last_activity_by_name'  => 'IF(tbl.modified_on, modifier.name, creator.name)',
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);

        $query->join(array('categories' => 'data.fora_categories'), 'categories.fora_category_id = tbl.fora_category_id')
              ->join(array('creator' => 'users'), 'creator.users_user_id = tbl.created_by')
              ->join(array('modifier' => 'users'), 'modifier.users_user_id = tbl.modified_by');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        if(is_numeric($state->published)) {
            $query->where('tbl.published = :published')->bind(array('published' => (int) $state->published));
        }

        if($state->search) {
            $query->where('(tbl.title LIKE :search)')->bind(array('search' => '%'.$state->search.'%'));
        }

        if($state->searchword) {
            $query->where('(tbl.title LIKE :search OR tbl.text LIKE :search )')->bind(array('search' => '%'.$state->searchword.'%'));
        }

        if(is_numeric($state->category)) {
            $query->where('tbl.fora_category_id = :category')->bind(array('category' => $state->category));
        }
    }
}