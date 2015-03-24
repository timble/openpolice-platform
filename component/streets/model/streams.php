<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
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

        if (isset($_SERVER['PHP_AUTH_USER']))
        {
            $url = $this->getObject('application')->getRequest()->getUrl();

            $this->_authentication = $url->getUser() . ':' . $url->getPass();
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

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, (string) $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: ' . $host));
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);

                if ($this->_authentication) {
                    curl_setopt($ch, CURLOPT_USERPWD, $this->_authentication);
                }

                $result = curl_exec($ch);

                if (curl_errno($ch)) {
                    throw new \Exception('Failed to fetch ' . $state->url . ': ' . curl_error($ch));
                }

                curl_close($ch);

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