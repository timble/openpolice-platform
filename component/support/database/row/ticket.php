<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

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
