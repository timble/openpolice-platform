<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class AboutViewHtml extends Library\ViewHtml
{
    public function render()
    {
        $this->categories = $this->getObject('com:questions.model.categories')->table('about')->published(true)->sort('ordering')->getRowset();

        return parent::render();
    }
}