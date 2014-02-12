<?php
namespace Nooku\Component\Swiftmailer;

use Nooku\Library;

class ControllerMail extends Library\ControllerAbstract
{
    protected $_mailer;

    public function __construct(Library\ObjectConfig $config)
    {
        require_once(JPATH_VENDOR.DS.'swiftmailer'.DS.'swiftmailer'.DS.'lib'.DS.'swift_required.php');

        parent::__construct($config);

        switch($config->method)
        {
            case 'smtp':
                $transport = \Swift_SmtpTransport::newInstance($config->smtphost, $config->smtpport);

                if(!empty($config->smtpsecure) && $config->smtpsecure != 'none') {
                    $transport->setEncryption($config->smtpsecure);
                }

                if((int) $config->smtpauth == 1)
                {
                    $transport->setUsername($config->smtpuser)
                        ->setPassword($config->smtppass);
                }
                break;
            default:
                $transport = \Swift_MailTransport::newInstance();
                break;
        }

        $this->_mailer = \Swift_Mailer::newInstance($transport);
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $application = $this->getObject('application');

        $config->append(array(
            'method'        => $application->getCfg('mailer'),
            'smtphost'      => $application->getCfg('smtphost', 'localhost'),
            'smtpport'      => $application->getCfg('smtpport', 25),
            'smtpsecure'    => $application->getCfg('smtpsecure', 'none'),
            'smtpauth'      => $application->getCfg('smtpauth', false),
            'smtpuser'      => $application->getCfg('smtpuser'),
            'smtppass'      => $application->getCfg('smtppass')
        ));

        parent::_initialize($config);
    }

    protected function _actionSend(Library\CommandContext $context)
    {
        $data        = $context->request->data;

        $message = \Swift_Message::newInstance()
            ->setSubject($data->subject)
            ->setFrom($data->from)
            ->setBody($data->html, 'text/html')
            ->addPart($data->plain, 'text/plain');

        foreach($data['to'] as $to)
        {
            $message->setTo($to);
            $this->_mailer->send($message);
        }

        return true;
    }
}