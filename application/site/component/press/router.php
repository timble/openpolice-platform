<?php
/**
 * Belgian Police Web Platform - Press Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class PressRouter extends Library\DispatcherRouter
{
    public function build(Library\HttpUrl $url)
    {
        $segments = array();
        $query    = &$url->query;

        if(isset($query['Itemid'])) {
            $page = $this->getObject('application.pages')->getPage($query['Itemid']);
        } else {
            $page = $this->getObject('application.pages')->getActive();
        }

        $view = $page->getLink()->query['view'];

        if($view == 'articles')
        {
            if(isset($query['id'])) {
                $segments[] = $query['id'];
            }
        }

        //Todo : move to the the generic component router
        if(isset($page->getLink()->query['layout']) && isset($query['layout']))
        {
            if($page->getLink()->query['layout'] == $query['layout']) {
                unset($query['layout']);
            }
        }

        unset($query['id']);
        unset($query['view']);

        unset($query['limit']);
        unset($query['sort']);
        unset($query['direction']);
        unset($query['published']);

        return $segments;
    }

    public function parse(Library\HttpUrl $url)
    {
        $vars = array();
        $path = &$url->path;

        $page = $this->getObject('application.pages')->getActive();

        $view  = $page->getLink()->query['view'];

        if($view == 'articles')
        {
            $segment = array_shift( $path) ;

            $vars['id']     = $segment;
            $vars['view']   = 'article';
            $vars['layout'] = 'default';
        }

        return $vars;
    }
}

