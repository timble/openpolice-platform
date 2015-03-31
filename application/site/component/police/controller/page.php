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
        $path   = array_values(array_filter($url->getPath(true)));

        $languages  = $this->getObject('application.languages');

        $redirect = false;
        $language = false;

        if($context->request->getFormat() == 'html')
        {
            // Are we dealing with a multilingual site?
            if(count($languages) > 1)
            {
                // Do we have language information in the path?
                $language = isset($path[1]) ? $path[1] : null;

                // No language found, fallback on the browser
                if(!$language || !in_array($language, $languages->get('slug')))
                {
                    if($hostLanguage = $this->getObject('com:police.controller.language')->findLanguage($host))
                    {
                        // Make sure the given language is enabled
                        if(in_array($hostLanguage, $languages->slug))
                        {
                            $language = $hostLanguage;
                        }
                    }

                    if ($language) {
                        $redirect = true;
                    }
                }

                // Redirect to the selected language
                if(isset($url->query['language']))
                {
                    $language = $url->query['language'];
                    $redirect = true;
                }
            }

            // Still no language, use the primary
            if(!$language)
            {
                $language = $languages->getPrimary()->slug;

                if (count($languages) > 1) {
                    $redirect = true;
                }
            }

            // Check if the correct domain name is used for the language
            $preferred = $this->getObject('com:police.controller.language')->findHost($host, $language);
            if($preferred && $preferred != $host)
            {
                $host     = $preferred;
                $redirect = true;
            }

            if($redirect)
            {
                // Do not add the language slug if we are on a single-language site
                if (count($languages) == 1) {
                    $language = null;
                }

                $site = $this->getObject('application')->getSite();
                $path = array_filter(array($site, $language));

                $this->getObject('component')->redirect('http://'.$host.'/'.implode('/',$path));

                return true;
            }
        }

        return $page;
    }
}