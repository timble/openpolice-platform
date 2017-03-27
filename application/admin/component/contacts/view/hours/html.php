<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class ContactsViewHoursHtml extends Library\ViewHtml
{
    public function render()
    {
        $this->contacts = $this->getObject('com:contacts.model.contacts')->sort('title')->getRowset();
        $this->categories = $this->getObject('com:contacts.model.categories')->sort('title')->hidden(false)->getRowset();

        return parent::render();
    }
}