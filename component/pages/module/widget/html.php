<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Pages;

use Nooku\Library;

/**
 * Widget Module Html View
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Pages
 */
class ModuleWidgetHtml extends ModuleDefaultHtml
{
    public function render()
    {
    	$function = '_'.$this->module->params->get('layout', 'overlay');
    	return $this->$function();
    }

    public function _inline()
    {
        $url = $this->getObject('lib:http.url', array('url' => $this->module->params->get('url')));

        $parts   = $url->getQuery(true);
        $package = substr($parts['option'], 4);
        $view    = Library\StringInflector::singularize($parts['view']);

        $identifier = 'com:'.$package.'.controller.'.$view;

        //Render the component
        $html = $this->getObject($identifier, array('request' => $parts))->render();

        return $html;
    }

    public function _overlay()
    {
        $helper = $this->getTemplate()->getHelper('behavior');

        $route   = $this->getRoute($this->module->params->get('url'));
        $options = array('options' => array('selector' => $this->module->params->get('selector', 'body')));

        //Create the overlay
        $html = $helper->overlay(array('url' => $route, $options));

        return $html;
    }
} 