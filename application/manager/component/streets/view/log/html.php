<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
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