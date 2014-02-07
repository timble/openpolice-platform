<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class SupportViewTicketHtml extends Library\ViewHtml
{
    public function render()
    {
        $ticket = $this->getModel()->getData();

        $this->user = $this->getObject('user');

        if($this->getLayout() == 'default')
        {
            $this->comments = $this->getObject('com:support.model.comments')->sort('created_on')->direction('desc')->table('support_tickets')->row($ticket->id)->getRowset();
        }

        return parent::render();
    }
}