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

class ModelLinks extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('crawled', 'int')
            ->insert('internal', 'int')
            ->insert('zone',    'string')
            ->insert('status',  'int');
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);


        //Exclude joins if counting records
        if(!$query->isCountQuery())
        {
            $query->columns(array('links'));

            $subquery = $this->getObject('lib:database.query.select')
                ->columns(array('links_link_id', 'links' => 'COUNT(linked_on)'))
                ->table('data.links_relations')
                ->group('links_link_id');

            $query->join(array('content' => $subquery), 'content.links_link_id = tbl.links_link_id');

        }
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        $site = $this->getObject('application')->getSite();

        if(is_numeric($state->crawled)) {
            $query->where('tbl.crawled = :crawled')->bind(array('crawled' => $state->crawled));
        }

        if(is_numeric($state->status)) {
            $query->where('tbl.status = :status')->bind(array('status' => $state->status));
        }

        if(is_numeric($state->internal)) {
            $query->where('tbl.internal = :internal')->bind(array('internal' => $state->internal));
        }

        if(!in_array($site, array('default'))) {
            $query->where('tbl.police_zone_id = :zone')->bind(array('zone' => $site));
        }
    }
}