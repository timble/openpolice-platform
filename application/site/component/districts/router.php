<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class DistrictsRouter extends Library\DispatcherRouter
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

        if($view == 'districts')
        {
            if(isset($query['id'])) {
                $segments[] = $query['id'];
            }
        }

        unset($query['id']);
        unset($query['view']);

        return $segments;
    }

    public function parse(Library\HttpUrl $url)
    {
        $vars = array();

        $page = $this->getObject('application.pages')->getActive();

        $view  = $page->getLink()->query['view'];
        $count = count($segments);

        if($view == 'districts')
        {
            $segment = array_shift( $segments) ;

            $vars['id'] = $segment;
            $vars['view'] = 'district';
        }

        return $vars;
    }
}

