<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
use Nooku\Library;

class TrafficTemplateHelperRoute extends PagesTemplateHelperRoute
{
    public function article($config = array())
	{
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout'   => null
        ));

        $article = $config->row;

        $needles = array(
            array('view' => 'article' , 'id' => $article->id),
		);

        $route = array(
            'view'     => 'article',
            'id'       => $article->getSlug(),
            'layout'   => $config->layout
        );

		if($item = $this->_findPage($needles)) {
			$route['Itemid'] = $item->id;
		};

		return $this->getTemplate()->getView()->getRoute(http_build_query($route, '', '&'));
	}

    public function category($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout' => null
        ));

        $category = $config->row;

        $needles = array(
            array('view' => 'articles', 'category' => $category->id),
        );

        $route = array(
            'view'     => 'articles',
            'category' => $category->getSlug(),
            'layout'   => $config->layout
        );

        if($page = $this->_findPage($needles))
        {
            if(isset($page->getLink()->query['layout'])) {
                $route['layout'] = $page->getLink()->query['layout'];
            }

            $route['Itemid'] = $page->id;
        };

        return $this->getTemplate()->getView()->getRoute($route);
    }
}