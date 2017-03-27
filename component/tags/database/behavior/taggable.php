<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Tags;

use Nooku\Library;

/**
 * Taggable Database Behavior
 *   
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Tags
 */
class DatabaseBehaviorTaggable extends Library\DatabaseBehaviorAbstract
{
	/**
	 * Get a list of tags
	 * 
	 * @return DatabaseRowsetTags
	 */
	public function getTags()
	{
        $model = $this->getObject('com:tags.model.relations');

        if(!$this->isNew())
        {
            $tags = $model->row($this->id)
                ->table($this->getTable()->getName())
                ->getRowset();
        }
        else $tags = $model->getRowset();

        return $tags;
	}
        
    /**
	 * Modify the select query
	 * 
	 * If the query's where information includes a tag propery, auto-join the tags tables with the query and select
     * all the rows that are tagged with a term.
	 */
	protected function _beforeTableSelect(Library\CommandContext $context)
	{
		$query = $context->query;
		
		if(!is_null($query)) 
		{
            foreach($query->where as $key => $where) 
			{	
                if($where['condition'] == 'tbl.tag') 
                {
                    $table = $context->caller;
                                        
					$query->where('tags.slug', $where['constraint'],  $where['value']);
					$query->where('tags_relations.table','=', $table->getName());
					$query->join('LEFT', 'tags_relations AS tags_relations', 'tags_relations.row = tbl.'.$table->getIdentityColumn());
					$query->join('LEFT', 'tags AS tags', 'tags.tags_tag_id = tags_relations.tags_tag_id');
				
					unset($context->query->where[$key]);
				}
			}
		}
	}
}