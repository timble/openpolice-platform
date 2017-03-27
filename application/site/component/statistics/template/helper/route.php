<?php
/**
 * Belgian Police Web Platform - Statistics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class StatisticsTemplateHelperRoute extends PagesTemplateHelperRoute
{
    public function city($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout'   => null
        ));

        $city = $config->row;

        $route = array(
            'view'     => 'city',
            'id'       => $city->id,
        );

        return $this->getTemplate()->getView()->getRoute($route);
    }
}