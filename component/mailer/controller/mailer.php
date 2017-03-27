<?php
/**
 * Belgian Police Web Platform - Mailer Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Mailer;

use Nooku\Library;

class ControllerMailer extends Library\ControllerAbstract
{
    protected $_method;

    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->_method = $config->method;
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $application = $this->getObject('application');

        $config->append(array(
            'method' => $application->getCfg('mailer', 'mail')
        ));

        parent::_initialize($config);
    }

    protected function _actionSend(Library\CommandContext $context)
    {
        switch($this->_method)
        {
            case 'sendgrid':
                $identifier = 'com:sendgrid.controller.mail';
                break;
            default:
                $identifier = 'com:swiftmailer.controller.mail';
                break;
        }

        $mail = $this->getObject($identifier);

        return $mail->send($context->request->data->toArray());
    }
}
