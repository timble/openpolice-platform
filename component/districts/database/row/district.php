<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

namespace Nooku\Component\Districts;
use Nooku\Library;

class DatabaseRowDistrict extends Library\DatabaseRowTable
{   
    public function save() {
    	
    	$result = parent::save();
    
    	if($this->officers) {

	    	// Save selected Officers to relation table 'districts_officers'
	    	foreach ($this->officers as $key => $value) {
	    		$relation = $this->getObject('com:districts.database.row.districts_officers');
	    		
	    		$relation->districts_district_id	= $this->id;
	    		$relation->districts_officer_id		= $value;
	    		
	    		if(!$relation->load()) {
	    			$relation->save();
	    		}
	    	}
	    	
	    	// Get all relation records for the selected district
	    	foreach ($this->getObject('com:districts.model.districts_officers')->districts_district_id($this->id)->getRowset() as $key => $value) {
	    		
	    		// Remove all officers that are no longer selected
	    		if (!in_array($value->districts_officer_id, $this->officers)) {
					$this->getObject('com:districts.model.districts_officers')->districts_district_id($this->id)->districts_officer_id($value->districts_officer_id)->getRow()
	    			    ->delete();
	    		}
	    	}
    	}
       
        return $result;
    }
    
    public function delete()
    {   	
    	// Remove records in jos_districts_relations
    	foreach ($this->getObject('com:districts.model.relations')->districts_district_id($this->id)->getRowset() as $value) {
    		$this->getObject('com:districts.model.relations')->id($value->id)->getRow()->delete();
    	}
    	
    	// Remove records in jos_districts_districts_officers
    	foreach ($this->getObject('com:districts.model.districts_officers')->district($this->id)->getRowset() as $value) {
    		$this->getObject('com:districts.model.districts_officers')->districts_district_id($this->id)->districts_officer_id($value->districts_officer_id)->getRow()->delete();
    	}
    		
    	return parent::delete();
    }
}