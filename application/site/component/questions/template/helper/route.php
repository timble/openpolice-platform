<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
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

        $category = $this->getObject('com:questions.model.category')->id($question->questions_category_id)->getRow();

        $route = array(
            'view'     => 'question',
            'id'       => $question->getSlug(),
            'layout'   => 'default',
            'category' => $category->getSlug(),
            'Itemid'   => '36'
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
            'view'          => 'questions',
            'category'      => $category->getSlug(),
            'layout'        => 'default',
            'searchword'    => null,
            'Itemid'        => '36'
        );

        $state    = $this->getTemplate()->getView()->getModel()->getState();
        $current  = $state->category;
        $offset   = $state->offset;

        if ($category->id != $current && $offset > 0)
        {
            $route['offset'] = null;
        }

        return $this->getTemplate()->getView()->getRoute($route);
    }
}