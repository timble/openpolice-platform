<?php
/**
 * Belgian Police Web Platform - HipChat Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Hipchat;

use Nooku\Library;

class ControllerMessage extends Library\ControllerAbstract
{
    const YELLOW = 'yellow';
    const RED    = 'red';
    const PURPLE = 'purple';
    const GRAY   = 'gray';
    const GREEN  = 'green';
    const RANDOM = 'random';

    protected $_token;
    protected $_room;
    protected $_from;

    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->_token = $config->token;
        $this->_room  = $config->room;
        $this->_from  = $config->from;
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $application = $this->getObject('application');

        $config->append(array(
            'room'   => 'Police Support',
            'from'   => 'Ticket Master',
            'token'  => $application->getCfg('hipchat_token')
        ));

        parent::_initialize($config);
    }

    protected function _actionSend(Library\CommandContext $context)
    {
        $data = $context->request->data;

        if(empty($this->_token)) {
            return false;
        }

        $transport = new \rcrowe\Hippy\Transport\Guzzle($this->_token, $this->_room, $this->_from);

        if($proxy = $this->getObject('application')->getCfg('http_proxy'))
        {
            $config  = $transport->getHttp()->getConfig();
            $request = $config->get('request.options');

            $request['proxy']  = $proxy;
            $request['verify'] = false;

            $config->set('request.options', $request);
        }

        $hippy   = new \rcrowe\Hippy\Client($transport);
        $message = new \rcrowe\Hippy\Message(true);

        if($data->bgcolor) {
           $message->setBackgroundColor($data->bgcolor);
        }

        // HipChat doesn't allow <p> tags so replace them with breaks:
        $content = preg_replace("/<p[^>]*?>/", "", $data->message);
        $content = str_replace("</p>", "<br /><br />", $content);
        // Make sure to remove any trailing breaks
        $content = preg_replace('/(<br ?\/?>\s*)+$/', '', $content);

        $message->setHtml($content);
        $hippy->send($message);

        return true;
    }
}