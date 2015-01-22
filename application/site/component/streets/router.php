<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class StreetsRouter extends Library\DispatcherRouter
{
    public function build(Library\HttpUrl $url)
    {
        $segments = array();
        $query    = &$url->query;

        unset($query['view']);
        unset($query['limit']);
        unset($query['sort']);

        return $segments;
    }

    public function parse(Library\HttpUrl $url)
    {
        $vars = array();

        return $vars;
    }
}

