<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
 
use Nooku\Library;

class ApplicationRouter extends Library\DispatcherRouter
{
    public function parse(Library\HttpUrl $url)
	{
        $vars = array();
        $path = trim($url->getPath(), '/');

        //Remove base path
        $path = substr_replace($path, '', 0, strlen($this->getObject('request')->getBaseUrl()->getPath()));

        // Set the format
        if(!empty($url->format)) {
            $url->query['format'] = $url->format;
        }

        //Parse site route
        $url->query['site'] = $this->getObject('application')->getSite();

        $path = str_replace($url->query['site'], '', $path);
        $path = ltrim($path, '/');

        //Parse component route
        if(!empty($path))
        {
            $segments = explode('/', $path);

            if(isset($segments[0]))
            {
                $vars['option'] = 'com_'.$segments[0];

                if(isset($segments[1])) {
                    $vars['view']   = $segments[1];
                } else {
                    $vars['view']   = $segments[0];
                }
            }
        }

        $url->query = array_merge($url->query, $vars);
        $url->path  = '';

        return true;
	}

	public function build(Library\HttpUrl $url)
	{
        $query    = &$url->query;
        $segments = array();

        // Build site route
        $site = $this->getObject('application')->getSite();

        // If the site parameter is set, overwrite it
        if (isset($query['site']))
        {
            $site = $query['site'];

            unset($query['site']);
        }

        if($site != 'default' && $site != $this->getObject('application')->getRequest()->getUrl()->toString(Library\HttpUrl::HOST)) {
            $segments[] = $site;
        }

	    //Build component route
        if(isset($query['option']))
        {
            $segments[] = substr($query['option'], 4);
            unset($query['option']);

            if(isset($query['view']))
            {
                if($query['view'] != $segments[0]) {
                    $segments[] = $query['view'];
                }

                unset($query['view']);
            }
        }

        $url->query = $query;

        //Add the format to the uri
        if(isset($url->query['format']))
        {
            $format = $url->query['format'];

            if($format != 'html') {
                $url->format = $format;
            }

            unset($url->query['format']);
        }

        // Build the full route
        $path = $this->getObject('request')->getBaseUrl()->getPath();

        // If the application parameter is set, replace /manager:
        if (isset($query['application']))
        {
            $application = $query['application'];

            if ($application == 'admin') {
                $application = 'administrator';
            }

            $path = str_replace('/manager', '/'.$application, $path);

            unset($query['application']);
        }

        $url->path = $path.'/'. implode('/', $segments);

        // Removed unused query variables
        unset($url->query['Itemid']);
        unset($url->query['option']);

        return true;
	}
}
