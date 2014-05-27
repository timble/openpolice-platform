<?php
namespace Nooku\Component\Announcements;

use Nooku\Library;

class ModelAnnouncements extends Library\ModelAbstract
{
    public function getRowset()
    {
        if (!isset($this->_rowset))
        {
            $feed = 'http://belgianpolice.github.io/blog.json';

            if ($proxy = $this->getObject('application')->getCfg('http_proxy'))
            {
                $proxy = str_replace('http://', 'tcp://', $proxy);

                $options = array(
                    'http' => array(
                        'proxy' => $proxy,
                        'request_fulluri' => true,
                    ),
                );
                $context = stream_context_create($options);

                $contents = file_get_contents($feed, null, $context);
            }
            else $contents = file_get_contents($feed);

            $contents = utf8_encode($contents);

            $data = json_decode($contents, true);

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
}