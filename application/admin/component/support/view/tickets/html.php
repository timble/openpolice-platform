<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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