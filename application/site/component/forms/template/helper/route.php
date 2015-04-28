<?php
/**
 * Belgian Police Web Platform - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class FormsTemplateHelperRoute extends PagesTemplateHelperRoute
{
    public function form($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout'   => null
        ));

        $form = $config->row;

        $route = array(
            'view'     => 'form',
            'id'       => $form->getSlug(),
            'layout'   => $config->layout,
        );

        return $this->getTemplate()->getView()->getRoute($route);
    }
}