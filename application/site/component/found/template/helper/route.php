<?php
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class FoundTemplateHelperRoute extends PagesTemplateHelperRoute
{
    public function item($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout'   => null,
            'category' => null
        ));

        $item = $config->row;

        $category = $this->getObject('com:found.model.category')->id($item->found_category_id)->getRow();

        $route = array(
            'view'     => 'article',
            'id'       => $item->getSlug(),
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