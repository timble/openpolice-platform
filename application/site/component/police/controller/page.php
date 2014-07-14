<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class PoliceControllerPage extends Library\ControllerView
{
    public function _actionRender(Library\CommandContext $context)
    {
        $page = parent::_actionRender($context);

        $url    = clone($context->request->getUrl());
        $host   = $url->getHost();
        $path   = $url->getPath();

        $site   = $this->getObject('application')->getSite();

        $languages  = $this->getObject('application.languages');
        $language    = $languages->getPrimary()->slug;

        $domains = array(
            'www.lokalepolitie.be'  => array('language' => 'nl', 'access' => 'live'),
            'www.policelocale.be'   => array('language' => 'fr', 'access' => 'live'),
            'www.lokalepolizei.be'  => array('language' => 'de', 'access' => 'live'),
            'p.pol-nl.be'           => array('language' => 'nl', 'access' => 'production'),
            'p.pol-fr.be'           => array('language' => 'fr', 'access' => 'production'),
            'p.pol-de.be'           => array('language' => 'de', 'access' => 'production'),
            's.pol-nl.be'           => array('language' => 'nl', 'access' => 'staging'),
            's.pol-fr.be'           => array('language' => 'fr', 'access' => 'staging'),
            's.pol-de.be'           => array('language' => 'de', 'access' => 'staging'),
        );

        $redirect = false;

        if($context->request->getFormat() == 'html')
        {
            // Are we dealing with a multilingual site?
            if(count($languages) > '1')
            {
                $route = str_replace($site, '', $path);
                $route = ltrim($route, '/');

                $route  = $languages->find(array('slug' => strtok($route, '/')))->top();

                // Do we have language information in the route?
                if(isset($route))
                {
                    $language = $route->slug;
                }
                else
                {
                    foreach($this->getObject('request')->getLanguages() as $browser_language)
                    {
                        if(in_array($browser_language, $languages->slug, true))
                        {
                            // Redirect to browser language
                            $path = rtrim($path, '/');
                            $path = $path.'/'.$browser_language;
                            $language = $browser_language;
                        }
                    }

                    $redirect = true;
                }
            }

            // Make sure we are using the proper domain name
            if(array_key_exists($host, $domains))
            {
                if($domains[$host]['language'] != $language)
                {
                    $needle = array('language' => $language, 'access' => $domains[$host]['access']);

                    $host = array_search($needle, $domains);

                    $redirect = true;
                }
            }

            if($redirect)
            {
                $this->getObject('component')->redirect('http://'.$host.$path);
                return true;
            }
        }


        return $page;
    }
}