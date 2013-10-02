<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class AboutTemplateHelperRoute extends PagesTemplateHelperRoute
{
    public function article($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout'   => null,
            'category' => null
        ));

        $article = $config->row;

        $category = $this->getObject('com:categories.model.category')->id($article->categories_category_id)->getRow();

        $route = array(
            'view'     => 'article',
            'id'       => $article->getSlug(),
            'layout'   => $config->layout,
            'category' => $category->getSlug()
        );

        return $this->getTemplate()->getView()->getRoute($route);
    }

    public function category($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout' => null
        ));

        $category = $config->row;

        $route = array(
            'view'          => 'articles',
            'category'      => $category->getSlug(),
            'layout'        => $config->layout
        );

        return $this->getTemplate()->getView()->getRoute($route);
    }
}