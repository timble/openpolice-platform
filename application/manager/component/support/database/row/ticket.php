<?php
use Nooku\Library;
use Nooku\Component\Support;

class SupportDatabaseRowTicket extends Support\DatabaseRowTicket
{
    protected $_es_comments;

    public function getCommentsFromElasticSearch()
    {
        if (!$this->_es_comments)
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

            $this->_es_comments = $rows;
        }

        return $this->_es_comments;
    }
}