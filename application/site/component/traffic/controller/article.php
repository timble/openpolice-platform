<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
use Nooku\Library;

class TrafficControllerArticle extends ApplicationControllerDefault
{
    public function getRequest()
	{
		$request = parent::getRequest();
        
        //Display only published items
		$request->query->published = 1;
		
        // Set the ordering
        $request->query->sort = 'start_on';
		$request->query->direction = 'ASC';
        
        // Only show upcoming articles
        $request->query->date = 'upcoming';
		
		return parent::getRequest();
	}
}