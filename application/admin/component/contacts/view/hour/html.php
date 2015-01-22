<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;

class ContactsViewHourHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the article
        $hour = $this->getModel()->getData();

        $this->closed = (is_null($hour->opening_time) || is_null($hour->closing_time)) && is_null($hour->appointment) && !$hour->isNew();

        return parent::render();
    }
}