<?php
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class FoundViewHtml extends Library\ViewHtml
{
    public function render()
    {
        $this->categories = $this->getObject('com:found.model.categories')->published(true)->sort('title')->getRowset();

        return parent::render();
    }
}