<?php
/**
 * Belgian Police Web Platform - Zone Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class PoliceViewZoneHtml extends Library\ViewHtml
{
    public function render()
    {
        $zone = $this->getModel()->getRow();

        $zone->titles = json_decode($zone->titles);
        $zone->social = json_decode($zone->social);

        return parent::render();
    }
}