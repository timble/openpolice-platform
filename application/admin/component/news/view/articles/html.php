<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class NewsViewArticlesHtml extends Library\ViewHtml
{
    public function render()
    {
        $date = new Library\Date(array('timezone' => 'GMT'));

        $this->now = $date->format('Y-m-d H:i:s');

        return parent::render();
    }
}