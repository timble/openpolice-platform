<?php
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
        $path = JPATH_ROOT.DS.'application'.DS.'admin'.DS.'component'.DS.'support'.DS.'view'.DS.'notification'.DS.'templates'.DS;

        $name = $this->getMixer()->getIdentifier()->name;
        $data = $context->data;

        if($name == 'comment')
        {
            $templates  = array('plain' => 'comment.plain', 'html' => 'comment.html');
            $ticket = $this->getObject('com:support.database.table.tickets')->select($data->row);

            $subject = 'New comment notification';

            $user   = $this->getObject('user');
            if($user->getRole() == 25)
            {
                $author = $this->getObject('com:users.database.table.users')->select($ticket->created_by);
                $recipients = array($author);
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

            $subject    = 'New ticket notification';
            $recipients = $this->getObject('com:users.model.users')
                ->enabled(true)
                ->role(25)
                ->getRowset()
                ->toArray();
        }

        // Add the link to the topic
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

        $data = array('ticket' => $ticket, 'subject' => $subject, 'url' => $url);

        $html  = $this->getObject('com:support.view.ticket')->getTemplate()->loadFile('com:support.view.notification.'.$templates['html'], $data);
        $plain = $this->getObject('com:support.view.ticket')->getTemplate()->loadFile('com:support.view.notification.'.$templates['plain'], $data);

        $this->_sendMail($recipients, $subject, $html, $plain);
    }

    protected function _sendMail($recipients, $subject, $html, $plain)
    {
        require_once(JPATH_VENDOR . DS . 'swiftmailer' . DS . 'swiftmailer' .DS . 'lib' . DS . 'swift_required.php');

        $application = $this->getObject('application');

        // $transport = \Swift_MailTransport::newInstance();

        $transport = \Swift_SmtpTransport::newInstance('localhost',1025);
        $mailer    = \Swift_Mailer::newInstance($transport);


        $message = \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom(array($application->getCfg('mailfrom') => $application->getCfg('fromname')))
                    ->setBody($html, 'text/html')
                    ->addPart($plain, 'text/plain');

        foreach($recipients as $recipient)
        {
            $message->setTo(array($recipient['email'] => $recipient['name']));
            $mailer->send($message);
        }
    }
}
