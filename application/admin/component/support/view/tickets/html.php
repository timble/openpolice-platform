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
 * Tickets HTML View
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Support
 */
class SupportViewTicketsHtml extends Library\ViewHtml
{
    public function render()
    {
        $this->user = $this->getObject('user')->getId();
        $this->statuses = $this->getObject('com:support.model.statuses')->getRowset()->text;

        return parent::render();
    }
}