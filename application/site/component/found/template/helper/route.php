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
        ));

        $item = $config->row;

        $route = array(
            'view'     => 'article',
            'id'       => $item->getSlug(),
            'layout'   => $config->layout
        );

        return $this->getTemplate()->getView()->getRoute($route);
    }
}