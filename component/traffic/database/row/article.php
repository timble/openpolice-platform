<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

namespace Nooku\Component\Traffic;
use Nooku\Library;

class DatabaseRowArticle extends Library\DatabaseRowTable
{   
    public function save()
    {
    	$result = parent::save();

        if($this->streets) {
        
	    	// Save selected streets to relation table
	    	foreach ($this->streets as $key => $value) {
	    		$relation = $this->getObject('com:streets.database.row.relations');
	    		
	    		$relation->row					= $this->id;
	    		$relation->table				= 'traffic_articles';
	    		$relation->streets_street_id	= $value;
	    		
	    		if(!$relation->load()) {
	    			$relation->save();
	    		}
	    	}
        	    	
	    	// Get all relations for the selected control
	    	foreach ($this->getObject('com:streets.model.relations')->row($this->id)->table('traffic_articles')->getRowset() as $key => $value) {
	    		
	    		// Remove all streets that are no longer selected
	    		if (!in_array($value->streets_street_id, $this->streets)) {
					$this->getObject('com:streets.model.relations')->row($this->id)->streets_street_id($value->streets_street_id)->table('traffic_articles')->getRow()->delete();
	    		}
	    	}
    	}
       
        return $result;
    }
    
    public function delete()
    {
    	//Remove street relation
    	$street_relation = $this->getObject('com:streets.database.row.relation');
    	$street_relation->table = 'traffic_articles';
    	$street_relation->row 	= $this->id;
    	
    	if($street_relation->load()) {
    		$street_relation->delete();
    	}
    	
    	return parent::delete();
    }
}