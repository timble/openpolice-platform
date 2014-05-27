<?php
namespace Nooku\Component\Announcements;

use Nooku\Library;

class ModelAnnouncements extends Library\ModelAbstract
{
    public function getRowset()
    {
        if (!isset($this->_rowset))
        {
            $contents = file_get_contents('http://belgianpolice.github.io/blog.json');
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