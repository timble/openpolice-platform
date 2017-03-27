<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Streets;

use Nooku\Library;

class ModelStreams extends Library\ModelAbstract
{
    protected $_items;

    protected $_authentication;

    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('url', 'url');
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        parent::_initialize($config);

        $headers = $this->getObject('application')->getRequest()->headers;

        if ($headers->has('PHP_AUTH_USER')) {
            $this->_authentication = $headers->get('PHP_AUTH_USER') . ':' . $headers->get('PHP_AUTH_PW');
        }
    }

    public function getItems()
    {
        if (!$this->_items)
        {
            $state = $this->getState();

            if($state->url)
            {
                $url  = $this->getObject('lib:http.url', array('url' => $state->url));
                $host = $url->getHost();

                $url->setHost('127.0.0.1');

                $opts = array(
                    'http'=>array(
                        'method' => 'GET',
                        'header' => "Host: $host\r\n"
                    )
                );

                if ($this->_authentication)
                {
                    $auth = sprintf("Authorization: Basic %s\r\n", base64_encode($this->_authentication));
                    $opts['http']['header'] .= $auth;
                }

                $context = stream_context_create($opts);

                $fp = fopen((string) $url, 'r', false, $context);
                $result = '';
                while (!feof($fp)) {
                    $result .= fgets($fp);
                }
                fclose($fp);

                $data = json_decode($result);

                if (!$data) {
                    throw new \Exception('Invalid JSON returned from ' . $state->url);
                }

                $this->_items = $data->items;
            }
        }

        return $this->_items;
    }
}