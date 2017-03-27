<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Support;

use Nooku\Library;
use Nooku\Component\Slack;

class ControllerBehaviorBroadcastable extends Slack\ControllerBehaviorBroadcastable
{
    protected function _getMessage(Library\DatabaseRowAbstract $entity)
    {
        $name = $entity->getIdentifier()->name;

        $user = $this->getObject('user');
        $ticket = $name == 'ticket' ? $entity : $this->getObject('com:support.database.table.tickets')->select($entity->row, Library\Database::FETCH_ROW);

        $url  = $this->_getTicketURL($ticket->id);
        $link = '<'.$url.'|' . $ticket->title . '>';

        if ($name == 'ticket') {
            $message = 'New *ticket* ' . $link . ' created by _' . $user->getName().'_';
        } else {
            $message = 'New *'.$name.'* to ' . $link . ' by _' . $user->getName().'_';
        }

        return $message;
    }

    protected function _getAttachments(Library\DatabaseRowAbstract $entity)
    {
        $attachment = new \stdClass;

        $name   = $entity->getIdentifier()->name;
        $ticket = $name == 'ticket' ? $entity : $this->getObject('com:support.database.table.tickets')->select($entity->row, Library\Database::FETCH_ROW);
        $url    = $this->_getTicketURL($ticket->id);

        $attachment->fallback = 'Police support request <'.$url.'|' . $ticket->title . '> (#' . $ticket->id.')';
        $attachment->color    = $this->_getColor($entity);

        $fields = array();

        $status = new \stdClass;
        $status->title = \JText::_('Status');
        $status->value = \JText::_(ucfirst($ticket->status));
        $status->short = true;

        $fields[] = $status;

        $author = new \stdClass;
        $author->title = \JText::_('Posted by');
        $author->value = $this->getObject('user')->getName();
        $author->short = true;

        $fields[] = $author;

        $message = new \stdClass;
        $message->title = \JText::_('Message');
        $message->value = strip_tags($entity->text);
        $message->short = false;

        $fields[] = $message;

        $attachment->fields = $fields;

        return array($attachment);
    }

    protected function _getColor(Library\DatabaseRowAbstract $entity)
    {
        $request = $this->getMixer()->getRequest();
        $name    = $entity->getIdentifier()->name;

        if($name == 'ticket') {
            return Slack\ControllerMessage::RED;
        }
        elseif($name == 'comment' && $request->data->status == 'solved') {
            return Slack\ControllerMessage::GREEN;
        }

        return Slack\ControllerMessage::YELLOW;
    }

    protected function _getTicketURL($id)
    {
        $site       = $this->getMixer()->getRequest()->data->get('site', 'int');
        if (!$site) {
            $site = $this->getObject('application')->getSite();
        }

        $identifier = md5($site . '-' . $id);

        $host = $this->getObject('request')->getBaseUrl()->toString(Library\HttpUrl::SCHEME | Library\HttpUrl::HOST);
        $url  = $host.'/manager/support/ticket?id='.$identifier;

        return $url;
    }
}