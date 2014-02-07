<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class SupportViewTicketsHtml extends Library\ViewHtml
{
    public function render()
    {
        $this->user = $this->getObject('user')->getId();
        $this->statuses = $this->getObject('com:support.model.statuses')->getRowset()->text;

        return parent::render();
    }
}