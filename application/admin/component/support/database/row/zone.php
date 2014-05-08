<?php
use Nooku\Library;

class SupportDatabaseRowZone extends Library\DatabaseRowAbstract
{
    public function getComments()
    {
        return array();

        $comments = $this->getObject('com:support.model.comments')
            ->row($this->id)
            ->table($this->getTable()->getName())
            ->sort('created_on')
            ->direction('desc')
            ->getRowset();

        return $comments;
    }
}