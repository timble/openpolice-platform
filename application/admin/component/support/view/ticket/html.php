<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;

/**
 * Forums HTML View
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Support
 */
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