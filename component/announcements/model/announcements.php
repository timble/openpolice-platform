<?php
namespace Nooku\Component\Announcements;

use Nooku\Library;

class ModelAnnouncements extends Library\ModelAbstract
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('limit'    , 'int');
    }

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

            usort($data, function ($a, $b) {
                $a = strtotime($a['date']);
                $b = strtotime($b['date']);

                if ($a == $b) {
                    return 0;
                }

                return ($a > $b) ? -1 : 1;
            });

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