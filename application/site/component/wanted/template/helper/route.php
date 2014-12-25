<?php
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class WantedTemplateHelperRoute extends PagesTemplateHelperRoute
{
    public function section($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout' => null
        ));

        $section = $config->row;

        $route = array(
            'view'          => 'articles',
            'section'       => $section->getSlug(),
            'category'      => null,
            'layout'        => $config->layout
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
        $section = $this->getObject('com:wanted.model.section')->id($category->wanted_section_id)->getRow();

        $route = array(
            'view'          => 'articles',
            'section'       => $section->getSlug(),
            'category'      => $category->getSlug(),
            'layout'        => $config->layout
        );

        return $this->getTemplate()->getView()->getRoute($route);
    }

    public function article($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout'   => null,
            'category' => null
        ));

        $article = $config->row;


        $category = $this->getObject('com:wanted.model.category')->id($article->wanted_category_id)->getRow();
        $section = $this->getObject('com:wanted.model.section')->id($category->wanted_section_id)->getRow();

        $route = array(
            'view'     => 'article',
            'id'       => $article->getSlug(),
            'layout'   => $config->layout,
            'section'  => $section->getSlug(),
            'category' => $category->getSlug()
        );

        return $this->getTemplate()->getView()->getRoute($route);
    }
}