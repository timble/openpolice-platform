<?php
use Nooku\Library;

class SupportDatabaseRowZone extends Library\DatabaseRowAbstract
{
    public function getComments()
    {
        $context = new Library\CommandContext();
        $context->setSubject($this);

        $context->index    = 'support';
        $context->type     = 'comment';

        $query = new stdClass;
        $query->filtered = array();
        $query->filtered['filter']['bool']['must'] = array(
            array('term' => array('zone' => $this->zone)),
            array('term' => array('row' => $this->support_ticket_id)),
        );
        $context->query = $query;

        $sort = array();
        $column = new stdClass;
        $column->created_on = new stdClass;
        $column->created_on->order = 'desc';
        $sort[] = $column;

        $context->sort = $sort;

        $results = $this->getObject('com:elasticsearch.controller.document')
                    ->browse($context);

        $rows = array();
        foreach($results->hits as $document)
        {
            $row = $document->_source;
            $row->id = $document->_id;

            $rows[] = $row;
        }

        return $rows;
    }
}