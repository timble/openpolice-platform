<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\News;
use Nooku\Library;

class ModelArticles extends Library\ModelTable
{
	public function __construct(Library\ObjectConfig $config)
	{
		parent::__construct($config);

		$this->getState()
		    ->insert('published' , 'int')
            ->insert('category' , 'int')
            ->insert('sticky' , 'boolean', false);
	}
    
    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);
	
		$query->columns(array(
			'thumbnail'      => 'thumbnails.thumbnail',
            'ordering_date'  => 'IF(tbl.publish_on, tbl.created_on, tbl.created_on)'
		));
	}
    
    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);

        $query->join(array('attachments'  => 'attachments'), 'attachments.attachments_attachment_id = tbl.attachments_attachment_id')
              ->join(array('thumbnails'  => 'files_thumbnails'), 'thumbnails.filename = attachments.path');
    }
	
	protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
	{
	    parent::_buildQueryWhere($query);
		$state = $this->getState();

		if ($state->search) {
			$query->where('tbl.title LIKE :search')->bind(array('search' => '%'.$state->search.'%'));
		}
		
		if (is_numeric($state->published)) {
			$query->where('tbl.published = :published')->bind(array('published' => $state->published));
		}

        if($state->sticky === true) {
            $query->where('tbl.sticky = :sticky')->bind(array('sticky' => '1'));
        }

        if(is_numeric($state->category) || $state->category)
        {
            if($state->category)
            {
                $query->where('tbl.categories_category_id IN :categories_category_id' );

                if($state->category_recurse === true) {
                    $query->where('categories.parent_id IN :categories_category_id', 'OR');
                }   

                $query->bind(array('categories_category_id' => (array) $state->category));
            }
            else $query->where('tbl.categories_category_id IS NULL');
        }
	}
}