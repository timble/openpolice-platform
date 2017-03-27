<?php
/**
 * Belgian Police Web Platform - Statistics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class StatisticsRouter extends Library\DispatcherRouter
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

        if($view == 'cities')
        {
            if(isset($query['id'])) {
                $segments[] = $query['id'];
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

        if($view == 'cities')
        {
            $segment = array_shift( $path) ;

            $vars['id']     = $segment;
            $vars['view']   = 'city';
        }

        return $vars;
    }
}

