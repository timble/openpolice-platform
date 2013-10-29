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
 * Router
 *
 * @author   Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Fora
 */
class ForaRouter extends Library\DispatcherRouter
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

        $view = $query['view'];

        if($view == 'topics'){
            if(isset($query['category'])){
                $segments[] = $query['category'];
            }
            if(isset($query['forum'])){
                $segments[] = $query['forum'];
            }
        }

        if($view == 'topic'){
            if(isset($query['category'])){
                $segments[] = $query['category'];
            }
            if(isset($query['forum'])){
                $segments[] = $query['forum'];
            }
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

        if(isset($query['view']) && $query['view'] == 'comments') {
            $segments[] = 'comments';
        }

        if(isset($query['layout']) && $query['layout'] != "form" || !isset($query['layout']))
        {
            unset($query['category']);
            unset($query['id']);
            unset($query['view']);
            unset($query['forum']);
            unset($query['layout']);
        }

        return $segments;
    }

    public function parse(Library\HttpUrl $url)
    {
        $vars = array();
        $path = &$url->path;

        $page = $this->getObject('application.pages')->getActive();

        $view  = $page->getLink()->query['view'];
        $count = count($path);

        if($view == 'categories')
        {
            if($count)
            {
                $count--;
                $segment = array_shift( $path );

                $vars['category'] = $segment;
                $vars['view'] = 'category';
            }

            if($count)
            {
                $count--;
                $segment = array_shift( $path) ;
                $id = explode("-",$segment);
                $vars['forum']     = $id[0];
                $vars['view']   = 'topics';
                $vars['layout'] = 'default';
            }

            if($count)
            {
                $count--;
                $segment = array_shift( $path) ;
                $vars['id']     = $segment;
                $vars['view']   = 'topic';
                $vars['layout'] = 'default';
            }
        }

        if($view == 'topics')
        {
            $segment = array_shift( $path) ;

            $vars['id']     = $segment;
            $vars['view']   = $view;
            $vars['forum']  = $segment;
        }

        if(count($path) && $path[0] == 'comments')
        {
            $segment = array_shift( $path) ;

            $vars['view']    = 'comments';
            $vars['forum'] = $segment;
            unset($vars['id']);
        }

        return $vars;
    }

}