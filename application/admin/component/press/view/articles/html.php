<?php
/**
 * Belgian Police Web Platform - Press Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class PressViewArticlesHtml extends Library\ViewHtml
{
    public function render()
    {
        $date = new Library\Date(array('timezone' => 'GMT'));

        $this->now = $date->format('Y-m-d H:i:s');

        return parent::render();
    }
}