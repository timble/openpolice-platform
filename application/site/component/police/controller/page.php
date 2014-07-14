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
        $href   = '';

        $site   = $this->getObject('application')->getSite();

        $languages  = $this->getObject('application.languages');
        $primary    = $languages->getPrimary();

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
                $site   = $this->getObject('application')->getSite();

                $route = $url->getPath();
                $route = str_replace($site, '', $route);
                $route = ltrim($route, '/');

                $language  = $languages->find(array('slug' => strtok($route, '/')))->top();

                if(isset($language))
                {
                    $language = $language->slug;
                }
                else
                {
                    foreach($this->getObject('request')->getLanguages() as $browser_language)
                    {
                        if(in_array($browser_language, $languages->slug, true))
                        {
                            // Redirect to browser language
                            $language = $browser_language;
                        } else {
                            // Redirect to primary language
                            $language = $primary->slug;
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
                $this->getObject('component')->redirect('http://'.$host.'/'.$site.isset($language) ? '/'.$language : '');
                return true;
            }
        }


        return $page;
    }
}