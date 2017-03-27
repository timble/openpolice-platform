<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Streets;
use Nooku\Library;

class ModelLogs extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('type' , 'string')
            ->insert('action' , 'string');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        if ($state->search) {
            $query->where('tbl.name LIKE :search OR tbl.row LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
        }

        if ($state->type) {
            $query->where('tbl.type = :type')->bind(array('type' => $state->type));
        }

        if ($state->action) {
            $query->where('tbl.action = :action')->bind(array('action' => $state->action));
        }
    }
}