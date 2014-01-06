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
use Nooku\Library\DatabaseQuerySelect;

/**
 * Topics Model
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser
 * @package Nooku\Component\Fora
 */
class ModelTopics extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('forum'    , 'slug')
            ->insert('published', 'int');

        $this->getState()->remove('sort')->insert('sort', 'cmd', 'ordering');
    }
    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);

        $query->columns(array(
            'forum_title'               => 'forums.title',
            'created_by_name'           => 'creator.name',
            'fora_category_id'          => 'forums.fora_category_id',
            'last_activity_on'          => 'IF(tbl.modified_on, tbl.modified_on, tbl.created_on)',
            'last_activity_by_name'     => 'IF(tbl.modified_on, modifier.name, creator.name)',
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);

        $query->join(array('forums' => 'data.fora_forums'), 'forums.fora_forum_id = tbl.fora_forum_id')
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

        if(is_numeric($state->forum)) {
            $query->where('tbl.fora_forum_id = :forum')->bind(array('forum' => $state->forum));
        }

        if($state->search) {
            $query->where('(tbl.title LIKE :search)')->bind(array('search' => '%'.$state->search.'%'));
        }
    }
}