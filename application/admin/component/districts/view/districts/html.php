<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class DistrictsViewDistrictsHtml extends Library\ViewHtml
{
    public function render()
    {
        $this->districts_officers($this->getObject('com:districts.model.districts_officers')->getRowset());
        
        return parent::render();
    }
}