<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class StreetsViewLogHtml extends Library\ViewHtml
{
    public function render()
    {
        $zone = $this->getModel()->getRow();

        $zone->fields = json_decode($zone->fields, true);

        return parent::render();
    }
}