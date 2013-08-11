<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class QuestionsTemplateHelperRoute extends PagesTemplateHelperRoute
{
    public function question($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout'   => null,
            'category' => null
        ));

        $question = $config->row;

        $category = $this->getObject('com:categories.model.category')->id($question->categories_category_id)->getRow();

        $needles = array(
            array('view' => 'question' , 'id' => $question->id),
            array('view' => 'category', 'id' => $question->category),
        );

        $route = array(
            'view'     => 'question',
            'id'       => $question->getSlug(),
            'layout'   => $config->layout,
            'category' => $category->getSlug()
        );

        if($item = $this->_findPage($needles)) {
            $route['Itemid'] = $item->id;
        };

        return $this->getTemplate()->getView()->getRoute($route);
    }

    public function category($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout' => null
        ));

        $category = $config->row;

        $needles = array(
            array('view' => 'questions', 'category' => $category->id),
        );

        $route = array(
            'view'     => 'questions',
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