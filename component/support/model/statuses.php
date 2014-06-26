<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Support;

use Nooku\Library;

class ModelStatuses extends Library\ModelAbstract
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('type', 'cmd')
            ->insert('text', 'string');
    }

    public function getRow()
    {
        if(!isset($this->_item))
        {
            if($this->getState()->text)
            {
                $statuses = $this->getList();

                foreach($statuses as $status)
                {
                    if($status->text == $this->getState()->text) {
                        $this->_row = $status;
                    }
                }
            }
        }

        return $this->_row;
    }

    public function getRowset()
    {
        if(!isset($this->_list))
        {
            $data = array();

            $statuses = array('new', 'open', 'pending', 'solved');

            foreach($statuses as $status)
            {
                $data[] = array(
                    'text'      => $status
                );
            }

            $this->_rowset = $this->getObject('com:support.database.rowset.statuses', array('data' => $data));
        }

        return $this->_rowset;
    }
}