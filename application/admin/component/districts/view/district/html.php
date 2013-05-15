<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class DistrictsViewDistrictHtml extends Library\ViewHtml
{
    public function render()
    {        
        $district = $this->getModel()->getData();
        $officers = array();
        
        if($district->id){
        	$districts_officers = $this->getObject('com:districts.model.districts_officers')->district($district->id)->getRowset();
        	
        	foreach ($districts_officers as $key => $value) {
        		$officers[] = $value->districts_officer_id;
        	}
        }
        
        $this->officers($officers);
        
        return parent::render();
    }
}