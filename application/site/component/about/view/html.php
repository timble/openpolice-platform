<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class AboutViewHtml extends Library\ViewHtml
{
    public function render()
    {
        $this->categories = $this->getObject('com:about.model.categories')->published(true)->sort('ordering')->getRowset();

        return parent::render();
    }
}