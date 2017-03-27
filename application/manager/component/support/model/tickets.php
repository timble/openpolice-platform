<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;
use Nooku\Library\DatabaseQuerySelect;

class SupportModelTickets extends Library\ModelAbstract
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('id'    , 'md5', null, true)
            ->insert('sort'  , 'cmd', 'last_activity_on')
            ->insert('limit' , 'int')
            ->insert('offset', 'int')
            ->insert('status', 'cmd')
            ->insert('direction', 'cmd', 'desc')
            ->insert('matches', 'string', array());
    }

    public function onStateChange($name)
    {
        parent::onStateChange($name);

        // If limit has been changed, adjust offset accordingly
        if($name == 'limit')
        {
            $limit = $this->getState()->limit;

            $this->getState()->offset = $limit != 0 ? (floor($this->getState()->offset / $limit) * $limit) : 0;
        }
    }

    public function getRow()
    {
        if (!isset($this->_row))
        {
            $state = $this->getState();

            if($state->isUnique())
            {
                $context = new Library\CommandContext();
                $context->setSubject($this);

                $context->index    = 'support';
                $context->type     = 'ticket';
                $context->id       = $state->id;

                $document = $this->getObject('com:elasticsearch.controller.document')
                            ->read($context);

                $data = (array) $document->_source;
                $data['id'] = $document->_id;

                $this->_row = $this->createRow(array('data' => $data, 'status' => Library\Database::STATUS_LOADED));
            }
            else $this->_row = $this->createRow();
        }

        return parent::getRow();
    }

    public function getRowset()
    {
        if (!isset($this->_rowset))
        {
            $rowset = $this->createRowset();

            $context = new Library\CommandContext();
            $context->setSubject($this);

            $context->index    = 'support';
            $context->type     = 'ticket';

            if ($limit = $this->getState()->limit) {
                $context->limit = $limit;
            }

            if ($offset = $this->getState()->offset) {
                $context->offset = $offset;
            }

            if ($matches = $this->getState()->matches)
            {
                settype($matches, 'array');

                $query = new stdClass;
                $query->match = new stdClass;

                foreach ($matches as $field => $match)
                {
                    if (!empty($match)) {
                        $query->match->$field = $match;
                    }
                }

                $context->query = $query;
            }

            if ($this->getState()->sort)
            {
                $sort = array();
                $column = new stdClass;
                $column->{$this->getState()->sort} = new stdClass;
                $column->{$this->getState()->sort}->order = strtolower($this->getState()->direction);
                $sort[] = $column;

                $context->sort = $sort;
            }

            $result = $this->getObject('com:elasticsearch.controller.document')
                ->browse($context);

            $this->_total = $result->total;

            $rows = array();
            foreach($result->hits as $document)
            {
                $data = (array) $document->_source;
                $data['id'] = $document->_id;

                $rows[] = $data;
            }

            $rowset->addRow($rows);

            $this->_rowset = $rowset;
        }

        return parent::getRowset();
    }

    public function createRow(array $options = array())
    {
        $identifier        = clone $this->getIdentifier();
        $identifier->path  = array('database', 'row');
        $identifier->name  = Library\StringInflector::singularize($this->getIdentifier()->name);

        return $this->getObject($identifier, $options);
    }

    public function createRowset(array $options = array())
    {
        $identifier        = clone $this->getIdentifier();
        $identifier->path  = array('database', 'rowset');
        $identifier->name  = Library\StringInflector::pluralize($this->getIdentifier()->name);

        return $this->getObject($identifier, $options);
    }
}
