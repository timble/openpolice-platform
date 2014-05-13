<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Support;

use Nooku\Library;

class DatabaseBehaviorNotifiable extends Library\DatabaseBehaviorAbstract
{
    protected function _afterTableInsert(Library\CommandContext $context)
    {
        if(!($this->getMixer() instanceof Library\DatabaseRowInterface)) {
            return;
        }

        $data = $context->data;

        if($data->getStatus() != Library\Database::STATUS_CREATED) {
            return;
        }

        $name = $this->getMixer()->getIdentifier()->name;
        if(in_array($name, array('comment', 'ticket'))) {
            $this->_sendNotification($context);
        }
    }

    protected function _sendNotification(Library\CommandContext $context)
    {
        $name = $this->getMixer()->getIdentifier()->name;
        $data = $context->data;

        // Get the templates, ticket row and recipients
        if($name == 'comment')
        {
            $templates  = array('plain' => 'comment.plain', 'html' => 'comment.html');
            $ticket = $this->getObject('com:support.database.table.tickets')->select($data->row, Library\Database::FETCH_ROW);

            $user   = $this->getObject('user');
            if($user->getRole() == 25)
            {
                $author = $this->getObject('com:users.database.table.users')->select($ticket->created_by, Library\Database::FETCH_ROW);
                $recipients = array($author->toArray());
            }
            else
            {
                $recipients = $this->getObject('com:users.model.users')
                    ->enabled(true)
                    ->role(25)
                    ->getRowset()
                    ->toArray();
            }
        }
        else
        {
            $templates  = array('plain' => 'ticket.plain', 'html' => 'ticket.html');
            $ticket     = $data;

            $recipients = $this->getObject('com:users.model.users')
                ->enabled(true)
                ->role(25)
                ->getRowset()
                ->toArray();
        }

        // Create the route to the topic
        $parts = array(
            'view'   => 'ticket',
            'option' => 'com_support',
            'id'     => ($name == 'ticket' ? $data->id : $data->row)
        );

        $host = $this->getObject('request')->getBaseUrl()->toString(Library\HttpUrl::SCHEME | Library\HttpUrl::HOST);
        $path = $this->getObject('lib:dispatcher.router.route', array(
            'url'    => '?'.http_build_query($parts),
            'escape' => true
        ));

        $url = $host.$path;

        // Render the body of the mail
        $subject = 'Support: ' . $ticket->title;
        $data = array('ticket' => $ticket, 'author' => $this->getObject('user'), 'subject' => $subject, 'url' => $url);

        $html  = (string) $this->getObject('com:support.view.ticket')->getTemplate()->loadFile('com:support.view.notification.'.$templates['html'], $data);
        $plain = (string) $this->getObject('com:support.view.ticket')->getTemplate()->loadFile('com:support.view.notification.'.$templates['plain'], $data);

        // Finally, send out the messages
        $this->_sendMail($recipients, $subject, $html, $plain);
    }

    protected function _sendMail($recipients, $subject, $html, $plain)
    {
        $application = $this->getObject('application');

        $controller = $this->getObject('com:mailer.controller.mailer');
        $data = array(
            'subject' => $subject,
            'html'    => $html,
            'plain'   => $plain,
            'from'    => array($application->getCfg('mailfrom') => $application->getCfg('fromname'))
        );

        $to = array();
        foreach($recipients as $recipient) {
            $to[] = array($recipient['email'] => $recipient['name']);
        }

        $data['to'] = $to;

        $controller->send($data);
    }
}
