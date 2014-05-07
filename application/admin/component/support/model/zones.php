<?php
use Nooku\Library;
use Nooku\Library\DatabaseQuerySelect;

class SupportModelZones extends Library\ModelAbstract
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('sort', 'cmd', 'last_activity_on')
            ->insert('status', 'cmd')
            ->insert('direction', 'cmd', 'desc')
            ->insert('status', 'string');
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

            if ($status = $this->getState()->status)
            {
                $query = new stdClass;
                $query->match = new stdClass;
                $query->match->status = $status;

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

        return $this->_rowset;
    }

    public function createRowset(array $options = array())
    {
        $identifier        = clone $this->getIdentifier();
        $identifier->path  = array('database', 'rowset');
        $identifier->name  = Library\StringInflector::pluralize($this->getIdentifier()->name);

        return $this->getObject($identifier, $options);
    }
}