<?php
use Nooku\Library;

class SupportDatabaseRowTicket extends Library\DatabaseRowTable
{
    /**
     * Get a list of comments
     *
     * @return DatabaseRowsetComments
     */
    public function getComments()
    {
        $comments = $this->getObject('com:support.model.comments')
            ->row($this->id)
            ->table($this->getTable()->getName())
            ->sort('created_on')
            ->direction('desc')
            ->getRowset();

        return $comments;
    }
}