<?php
/**
 * Belgian Police Web Platform - Sendgrid Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Sendgrid;

use Nooku\Library;

class ControllerMail extends Library\ControllerAbstract
{
    protected $_endpoint;
    protected $_sendgrid_user;
    protected $_sendgrid_key;

    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->_endpoint = $config->endpoint;
        $this->_sendgrid_user     = $config->sendgrid_user;
        $this->_sendgrid_key      = $config->sendgrid_key;
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $application = $this->getObject('application');

        $config->append(array(
            'sendgrid_user' => $application->getCfg('sendgrid_user'),
            'sendgrid_key'  => $application->getCfg('sendgrid_key'),
            'endpoint'      => 'https://api.sendgrid.com/api/mail.send.json'
        ));

        parent::_initialize($config);
    }

    protected function _actionSend(Library\CommandContext $context)
    {
        $data        = $context->request->data;

        $keys = array_keys($data->from);
        $from = $keys[0];
        $fromname = $data->from[$from];

        $recipients = $data->to;

        if(!isset($recipients[0])) {
            throw new \RuntimeException('Missing e-mail recipient');
        }

        $first = $recipients[0];
        $keys = array_keys($first);
        $to = $keys[0];
        $toname = $first[$to];

        $postfields = array(
            'api_user'   => $this->_sendgrid_user,
            'api_key'    => $this->_sendgrid_key,
            'from'       => $from,
            'fromname'   => $fromname,
            'to'         => $to,
            'toname'     => $toname,
            'subject'    => $data->subject,
            'html'       => (string) $data->html,
            'text'       => (string) $data->plain
        );

        // If we have multiple recipients, use Sendgrid's x-smtpapi header to make sure
        // multiple recipients are hidden from each other.
        if(count($recipients))
        {
            $to = array();
            foreach($recipients as $recipient) {
                foreach($recipient as $email => $name) {
                    $to[] = $name . ' <' . $email . '>';
                }
            }

            $smtpapi = array('to' => $to);
            $postfields['x-smtpapi'] = json_encode($smtpapi);
        }

        return $this->_execCurl($postfields);
    }

    protected function _execCurl($payload)
    {
        $application = $this->getObject('application');

        if (!function_exists('curl_init')) {
            throw new \RuntimeException('Curl library does not exist');
        }

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL            => $this->_endpoint,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_POST           => 1,
            CURLOPT_POSTFIELDS     => $payload
        ));

        if($proxy = $application->getCfg('http_proxy')) {
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
        }

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            throw new \RuntimeException('Curl Error: '.curl_error($ch));
        }

        curl_close($ch);

        $result = json_decode($response);

        if(is_null($result)) {
            throw new \RuntimeException('Invalid JSON response from Sendgrid');
        }

        if($result->message == 'error')
        {
            $errors = implode("\n", $result->errors);

            throw new \RuntimeException('Sendgrid failed to send message: ' . $errors);
        }

        return true;
    }
}
