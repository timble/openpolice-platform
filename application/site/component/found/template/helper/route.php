<?php
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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