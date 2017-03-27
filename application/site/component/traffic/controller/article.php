<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class TrafficControllerArticle extends Library\ControllerModel
{
    public function getRequest()
	{
		$request = parent::getRequest();

        //Display only published items
		$request->query->published = 1;

        // Set the ordering
        $request->query->sort = 'start_on';
		$request->query->direction = 'ASC';

        if($request->query->get('view', 'cmd', null) == 'articles' && $request->query->get('layout', 'cmd', 'default') == 'default')
        {
            // Only show upcoming articles
            $request->query->date = 'upcoming';
        }

        if($request->query->get('view', 'cmd', null) == 'articles' && $request->query->get('layout', 'cmd', 'default') == 'results')
        {
            // Sort results in descending order
            $request->query->direction = 'DESC';
        }

		return parent::getRequest();
	}
}
