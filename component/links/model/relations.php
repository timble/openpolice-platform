<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Links;
use Nooku\Library;

class ModelRelations extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('links_link_id', 'string')
            ->insert('crawled', 'boolean');
    }

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);

        $query->columns(array(
            'child_url'     => 'links.url',
            'child_title'   => 'links.title',
            'child_status'  => 'links.status'
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);

        $query->join(array('links'  => 'data.links'), 'links.links_link_id = tbl.linked_on');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        if ($state->links_link_id) {
            $query->where('tbl.links_link_id = :links_link_id')->bind(array('links_link_id' => $state->links_link_id));
        }

        if ($state->crawled) {
            $query->where('tbl.crawled = :crawled')->bind(array('crawled' => $state->crawled));
        }
    }
}