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

class DatabaseRowRelation extends Library\DatabaseRowTable
{   
    public function save()
    {
    	$result = parent::save();

        if ($this->streets_street_id)
        {          
            $street_relation = $this->getObject('com:streets.database.row.relation');

            $street_relation->row = $this->id;
            $street_relation->table = 'districts_relations';
			
			// Remove the existing record
			if($street_relation->load()) {
				$street_relation->delete();
			}
			
			// Set the street ID and save the row
			$street_relation->streets_street_id = $this->streets_street_id;
			
			if(!$street_relation->load()) {
				$street_relation->save();
			}
        }
       
        return $result;
    }
    
    public function delete()
    {
    	//Remove street relation
    	$street_relation = $this->getObject('com:streets.database.row.relation');
    	$street_relation->table = 'districts_relations';
    	$street_relation->row = $this->id;
    	
    	if($street_relation->load()) {
    		$street_relation->delete();
    	}
    	
    	return parent::delete();
    }
}