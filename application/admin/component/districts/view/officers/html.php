<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class DistrictsViewOfficersHtml extends Library\ViewHtml
{
    public function render()
    {
        $this->districts_officers($this->getObject('com:districts.model.districts_officers')->getRowset());
        
        return parent::render();
    }
}