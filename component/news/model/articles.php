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
		    ->insert('exclude' , 'int')
            ->insert('sticky' , 'boolean', false);
	}
    
    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
	{
		parent::_buildQueryColumns($query);
	
		$query->columns(array(
			'thumbnail'         => 'thumbnails.thumbnail',
            'path'              => 'attachments.path',
            'created_by_name'   => 'creator.name',
            'ordering_date'     => 'IF(tbl.publish_on, tbl.publish_on, tbl.created_on)'
		));
	}
    
    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryJoins($query);

        $query->join(array('attachments'  => 'attachments'), 'attachments.attachments_attachment_id = tbl.attachments_attachment_id')
              ->join(array('thumbnails'  => 'files_thumbnails'), 'thumbnails.filename = attachments.path')
              ->join(array('creator'  => 'users'), 'creator.users_user_id = tbl.created_by');
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

        if ($state->exclude) {
            $query->where('tbl.news_article_id != :news_article_id')->bind(array('news_article_id' => $state->exclude));
        }
	}
}