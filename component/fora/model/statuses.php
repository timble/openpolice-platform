<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

namespace Nooku\Component\Fora;

use Nooku\Library;

/**
 * Statuses Model
 *
 * @author  Tom Janssens <https://nooku.assembla.com/profile/tomjanssens>
 * @package Nooku\Component\Fora
 */
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

            $statuses = array();
            $statuses['idea'] = array(
                'open' => array('new', 'planned', 'started'),
                'closed' => array('completed', 'declined')
            );

            $statuses['issue'] = array(
                'open' => array('new', 'open', 'pending'),
                'closed' => array('confirmed', 'solved', 'closed')
            );

            foreach($statuses as $type => $status)
            {
                if($this->getState()->type && $this->getState()->type != $type) {
                    continue;
                }

                foreach(array('open', 'closed') as $state)
                {
                    if(isset($status[$state]))
                    {
                        foreach($status[$state] as $name)
                        {
                            $data[] = array(
                                'text'      => $name,
                                'closed'    => ($state == 'open' ? false : true)
                            );
                        }
                    }
                }
            }

            $this->_rowset = $this->getObject('com:fora.database.rowset.statuses', array('data' => $data));
        }

        return $this->_rowset;
    }
}