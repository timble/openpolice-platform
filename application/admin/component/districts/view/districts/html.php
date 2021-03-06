<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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