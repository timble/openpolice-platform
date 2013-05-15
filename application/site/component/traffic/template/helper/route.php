<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
use Nooku\Library;

class TrafficTemplateHelperRoute extends PagesTemplateHelperRoute
{
    public function control($config = array())
	{
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout'   => null
        ));

        $control = $config->row;

        $needles = array(
            array('view' => 'control' , 'id' => $control->id),
		);

        $route = array(
            'view'     => 'control',
            'id'       => $control->getSlug(),
            'layout'   => $config->layout,
        );

		if($item = $this->_findPage($needles)) {
			$route['Itemid'] = $item->id;
		};

		return $this->getTemplate()->getView()->getRoute(http_build_query($route, '', '&'));
	}
	
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
            'layout'   => $config->layout,
        );

		if($item = $this->_findPage($needles)) {
			$route['Itemid'] = $item->id;
		};

		return $this->getTemplate()->getView()->getRoute(http_build_query($route, '', '&'));
	}
}