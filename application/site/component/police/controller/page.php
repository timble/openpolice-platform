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
            'p.pol-nl.be' => array('language' => 'nl', 'access' => 'production'),
            'p.pol-fr.be' => array('language' => 'fr', 'access' => 'production'),
            'p.pol-de.be' => array('language' => 'de', 'access' => 'production'),
            's.pol-nl.be' => array('language' => 'nl', 'access' => 'staging'),
            's.pol-fr.be' => array('language' => 'fr', 'access' => 'staging'),
            's.pol-de.be' => array('language' => 'de', 'access' => 'staging'),
        );

        $redirect = false;

        if(count($languages) > '1')
        {
            $site   = $this->getObject('application')->getSite();

            $route = $url->getPath();
            $route = str_replace($site, '', $route);
            $route = ltrim($route, '/');

            $language  = $languages->find(array('slug' => strtok($route, '/')));

            if(!count($language))
            {
                foreach($this->getObject('request')->getLanguages() as $language)
                {
                    if(in_array($language, $languages->slug, true))
                    {
                        // Redirect to browser language
                        $href = '/'.$language;
                    } else {
                        // Redirect to primary language
                        $href = '/'.$primary->slug;
                    }
                }

                $redirect = true;
            }

            if (isset($url->query['language']) && $context->request->getFormat() == 'html')
            {
                $config = array(
                    'package'   => null,
                    'category'  => null,
                    'language'  => $url->query['language']
                );

                $template = Library\ObjectManager::getInstance()->getObject('com:pages.view.page')->getTemplate();
                $href = $this->getObject('com:police.template.helper.string', array('template' => $template))->languages($config);

                $redirect = true;
            }
        }

        // Check if the domain language equals the primary language
        if(array_key_exists($host, $domains))
        {
            if($domains[$host]['language'] != $primary->slug)
            {
                $needle = array('language' => $primary->slug, 'access' => $domains[$host]['access']);

                $host = array_search($needle, $domains);

                $redirect = true;
            }
        }

        if($redirect)
        {
            $this->getObject('component')->redirect('http://'.$host.'/'.$site.$href);
            return true;
        }

        return $page;
    }
}