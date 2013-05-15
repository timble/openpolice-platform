<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

namespace Nooku\Component\Streets;
use Nooku\Library;

class DatabaseRowStreet extends Library\DatabaseRowTable
{
	/**
	 * Deletes the street form the database.
	 */
	public function delete()
	{		
		// Remove relations
		foreach ($this->getObject('com:streets.model.relations')->street($this->id)->getRowset() as $relation)
		{
		    //Load the relation
		    $street_relation = $this->getObject('com:streets.database.row.relation');
		    $street_relation->streets_street_id = $this->id;
		    $street_relation->table = $relation->table;
		    $street_relation->row = $relation->row;
		    
		    // Remove the existing record
		    if($street_relation->load()) {
		    	$street_relation->delete();
		    }
		}
 	
		return parent::delete();
	}
}