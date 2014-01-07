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
 * Comments Model
 *
 * @author  Terry Visser <https://nooku.assembla.com/profile/terryvisser>
 * @package Nooku\Component\Fora
 */
class ModelComments extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('topic', 'int');
    }

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);

        $query->columns(array(
            'created_by_name'           => 'creator.name',
            'last_activity_on'          => 'IF(tbl.modified_on, tbl.modified_on, tbl.created_on)',
            'last_activity_by_name'     => 'IF(tbl.modified_on, modifier.name, creator.name)',
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);

        $query->join(array('creator' => 'data.fora_users'), 'creator.users_user_id = tbl.created_by')
            ->join(array('modifier' => 'data.fora_users'), 'modifier.users_user_id = tbl.modified_by');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);

        if(!$this->getState()->isUnique())
        {
            if($this->getState()->topic) {
                $query->where('tbl.fora_topic_id = :topic')->bind(array('topic' => $this->getState()->topic));
            }
        }
    }
}