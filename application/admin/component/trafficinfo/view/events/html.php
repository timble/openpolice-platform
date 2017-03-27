<?php
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class TrafficinfoViewEventsHtml extends Library\ViewHtml
{
    public function render()
    {
        $this->places($this->getObject('com:trafficinfo.model.items')->set('group', 'places')->getRowset());
        $this->roads($this->getObject('com:trafficinfo.model.items')->set('group', 'roads')->getRowset());

        return parent::render();
    }
}
