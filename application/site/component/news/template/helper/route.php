<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class NewsTemplateHelperRoute extends PagesTemplateHelperRoute
{
    public function article($config = array())
	{
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout'   => null,
            'format'   => 'html'
        ));

        $article = $config->row;

        $needles = array(
            array('view' => 'article' , 'id' => $article->id),
		);

        $route = array(
            'view'     => 'article',
            'id'       => $article->getSlug(),
            'layout'   => $config->layout,
            'format'   => $config->format,
        );

		if($item = $this->_findPage($needles)) {
			$route['Itemid'] = $item->id;
		};

        return $this->getTemplate()->getView()->getRoute($route);
	}
}