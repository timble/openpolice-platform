<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;

/**
 * Route Template Helper
 *
 * @author  Johan Janssens <http://nooku.assembla.com/profile/johanjanssens>
 * @package Component\Articles
 */
class ForaTemplateHelperRoute extends PagesTemplateHelperRoute
{
    public function topics($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'view'   => 'topics',
            'layout' => null
        ));

        $forum = $config->row;
        $category = $this->getObject('com:fora.model.categories')->id($forum->categories_category_id)->table('fora_forums')->getRow();

        $route = array(
            'view'      => $config->view,
            'forum'     => $forum->getSlug(),
            'layout'    => $config->layout,
            'category'  => $category->getSlug()
        );

        return $this->getTemplate()->getView()->getRoute($route);
    }

    public function topic($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'view'   => 'topic',
            'layout' => null
        ));

        $topic = $config->row;

        $forum = $this->getObject('com:fora.model.forums')->id($topic->fora_forum_id)->getRow();
        $category = $this->getObject('com:fora.model.categories')->id($forum->categories_category_id)->table('fora_forums')->getRow();

        $route = array(
            'view'     => $config->view,
            'id'       => $topic->getSlug(),
            'layout'   => $config->layout,
            'category' => $category->getSlug(),
            'forum'    => $forum->getSlug(),
        );

        return $this->getTemplate()->getView()->getRoute($route);
    }

    public function search($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'view'   => 'topics',
            'layout' => 'search'
        ));

        $needles = array(
            array('view' => 'topics')
        );

        $route = array(
            'view'      => $config->view,
            'layout'    => $config->layout,
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