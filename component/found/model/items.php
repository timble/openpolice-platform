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

class ModelItems extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('published' , 'int')
            ->insert('category' , 'string')
            ->insert('sort', 'cmd', 'found_on')
            ->insert('direction', 'cmd', 'desc')
            ->insert('searchword', 'string');
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
        parent::_buildQueryJoins($query);

        $query->join(array('attachments'  => 'attachments'), 'attachments.attachments_attachment_id = tbl.attachments_attachment_id');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        if ($state->search) {
            $query->where('tbl.title LIKE :search OR tbl.tracking_number LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
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
    }
}
