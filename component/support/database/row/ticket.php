<?php
namespace Nooku\Component\Support;

use Nooku\Library;

class DatabaseRowTicket extends Library\DatabaseRowTable
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