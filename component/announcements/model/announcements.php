<?php
/**
 * Belgian Police Web Platform - Announcements Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Announcements;

use Nooku\Library;

class ModelAnnouncements extends Library\ModelAbstract
{
    protected $_ttl;

    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('limit'    , 'int');

        $this->_ttl = $config->ttl;
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'ttl' => (60 * 60 * 24)
        ));

        parent::_initialize($config);
    }

    public function getRowset()
    {
        if (!isset($this->_rowset))
        {
            $key = $this->_getKey();

            // @TODO When upgrading the framework, the apc functions should be moved into a model behavior.
            if (extension_loaded('apc'))
            {
                if(apc_exists($key))
                {
                    $data   = apc_fetch($key);
                    $data   = unserialize($data);
                }
                else
                {
                    $data = $this->_fetchData();
                    apc_store($key, serialize($data), $this->_ttl);
                }
            }
            else $data = $this->_fetchData();

            $this->_rowset = $this->createRowset(array(
                'data' => $data
            ));
        }

        return parent::getRowset();
    }

    public function createRowset(array $options = array())
    {
        $identifier         = clone $this->getIdentifier();
        $identifier->path   = array('database', 'rowset');

        return $this->getObject($identifier, $options);
    }

    protected function _getKey()
    {
        $state = $this->getState()->getValues();

        $key = $this->getIdentifier().':'.md5(http_build_query($state));

        return $key;
    }

    protected function _fetchData()
    {
        $feed = 'http://www.openpolice.be/blog.json';

        $options = array(
            'http' => array(
                'timeout' => 5,
                'method'  => 'GET'
            ),
        );

        if ($proxy = $this->getObject('application')->getCfg('http_proxy'))
        {
            $proxy = str_replace('http://', 'tcp://', $proxy);

            $options['http']['proxy'] = $proxy;
            $options['http']['request_fulluri'] = true;
        }

        $context = stream_context_create($options);
        $contents = @file_get_contents($feed, null, $context);

        if ($contents !== false)
        {
            $contents = utf8_encode($contents);

            $data = json_decode($contents, true);
        }
        else $data = array();

        usort($data, function ($a, $b) {
            $a = strtotime($a['date']);
            $b = strtotime($b['date']);

            if ($a == $b) {
                return 0;
            }

            return ($a > $b) ? -1 : 1;
        });

        foreach ($data as $key => $value) {
            $data[$key]['identifier'] = md5($value['date'] . $value['title']);
        }

        return $data;
    }
}
