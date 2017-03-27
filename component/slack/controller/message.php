<?php
/**
 * Belgian Police Web Platform - Slack Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Slack;

use Nooku\Library;

class ControllerMessage extends Library\ControllerAbstract
{
    const YELLOW = '#F0E771';
    const RED    = '#E32929';
    const PURPLE = '#C036E3';
    const GRAY   = '#CAC4CC';
    const GREEN  = '#5AE622';

    protected $_token;
    protected $_channel;
    protected $_from;

    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->_token   = $config->token;
        $this->_channel = $config->channel;
        $this->_from    = $config->from;

        $this->_emoji = $config->icon_emoji;
        $this->_icon  = $config->icon_url;
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $application = $this->getObject('application');

        $config->append(array(
            'channel'    => '#police-support',
            'from'       => 'Wilfried Pasmans',
            'token'      => $application->getCfg('slack_token'),
            'icon_emoji' => ':cop:',
            'icon_url'   => 'https://dl.dropboxusercontent.com/u/77404/timble/police/slack/pasmans.png'
        ));

        parent::_initialize($config);
    }

    protected function _actionSend(Library\CommandContext $context)
    {
        $data = $context->request->data;

        if(empty($this->_token)) {
            return false;
        }

        $payload = new \stdClass;
        $payload->username = $this->_from;
        $payload->text     = $data->message;

        if (!empty($this->_channel)) {
            $payload->channel = $this->_channel;
        }

        if (!empty($this->_icon)) {
            $payload->icon_url = $this->_icon;
        } elseif (!empty($this->_emoji)) {
            $payload->icon_emoji = $this->_emoji;
        }

        if (is_array($data->attachments) && count($data->attachments)) {
            $payload->attachments = $data->attachments;
        }

        $json = json_encode($payload);

        return $this->_execCurl($json);
    }

    protected function _execCurl($json)
    {
        $application = $this->getObject('application');

        if (!function_exists('curl_init')) {
            throw new \RuntimeException('Curl library does not exist');
        }

        $url = 'https://timble.slack.com/services/hooks/incoming-webhook?token=' . $this->_token;

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL            => $url,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_POST           => 1,
            CURLOPT_HTTPHEADER     => array('Content-Type: text/plain'),
            CURLOPT_POSTFIELDS     => $json
        ));

        if($proxy = $application->getCfg('http_proxy')) {
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
        }

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            throw new \RuntimeException('Curl Error: '.curl_error($ch));
        }

        curl_close($ch);

        if($response != 'ok') {
            throw new \RuntimeException('Slack failed to post the message: ' . $response);
        }

        return true;
    }
}