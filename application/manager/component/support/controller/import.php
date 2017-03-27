<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class SupportControllerImport extends Library\ControllerAbstract
{
    protected function _actionRender(Library\CommandContext $context)
    {
        $adapter = $this->getObject('lib:database.adapter.mysql');

        $query  = $this->getObject('lib:database.query.show')
            ->show('DATABASES')
            ->like(':like')
            ->bind(array('like' => '____'));

        $zones   = $adapter->select($query, Library\Database::FETCH_FIELD_LIST);
        $zones[] = 'fed';

        foreach ($zones as $zone)
        {
            if (in_array($zone, array('demo', 'data'))) {
                continue;
            }

            $adapter->setDatabase($zone);

            $query  = $this->getObject('lib:database.query.select')
                        ->columns('tbl.*')
                        ->columns(array(
                            'created_by_name'           => 'creator.name',
                            'modified_by_name'          => 'modifier.name',
                            'last_commented_by_name'    => 'commenter.name',
                            'last_activity_on'          => 'IF(tbl.last_commented_on, tbl.last_commented_on, IF(tbl.modified_on, tbl.modified_on, tbl.created_on))',
                            'last_activity_by'          => 'IF(tbl.last_commented_by, tbl.last_commented_by, IF(tbl.modified_by, tbl.modified_by, tbl.created_by))',
                            'last_activity_by_name'     => 'IF(tbl.last_commented_on, commenter.name, IF(tbl.modified_on, modifier.name, creator.name))',
                        ))
                        ->join(array('creator' => 'users'), 'creator.users_user_id = tbl.created_by')
                        ->join(array('modifier' => 'users'), 'modifier.users_user_id = tbl.modified_by')
                        ->join(array('commenter' => 'users'), 'commenter.users_user_id = tbl.last_commented_by')
                        ->limit(0);

            $tickets = $this->getObject('com:support.database.table.tickets')->select($query);

            foreach ($tickets as $ticket)
            {
                $ticket->support_ticket_id = $ticket->id;
                $ticket->zone = $zone;

                $document = $ticket->toArray();
                $document['id'] = md5($zone.'-'.$ticket->id);

                foreach($document as $key => $value)
                {
                    if (substr($key, 0, 1) == '_') {
                        unset($document[$key]);
                    }
                }

                $context = $this->_getCommandContext($ticket);
                $context->document = $document;

                $this->getObject('com:elasticsearch.controller.document')->add($context);

                echo 'Indexed ' . $zone . ' ticket #' . $ticket->id . ' (' . $ticket->title . ')';

                $comments = $ticket->getComments();

                echo ' with ' . count($comments) . ' comments';

                foreach ($comments as $comment)
                {
                    $comment->zone   = $zone;
                    $comment->parent = md5($comment->zone . '-' . $comment->row);
                    $comment->comments_comment_id = $comment->id;

                    $document = $comment->toArray();
                    $document['id'] = md5($zone.'-'.$comment->id);

                    $context = $this->_getCommandContext($comment);
                    $context->document = $document;

                    $this->getObject('com:elasticsearch.controller.document')->add($context);
                }

                echo '<br />' . PHP_EOL;
            }
        }

        exit();
    }

    protected function _getCommandContext($entity)
    {
        $context = new Library\CommandContext();
        $context->setSubject($this);

        $context->index    = $entity->getIdentifier()->package;
        $context->type     = $entity->getIdentifier()->name;

        return $context;
    }
}
