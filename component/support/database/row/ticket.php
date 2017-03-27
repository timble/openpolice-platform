<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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
