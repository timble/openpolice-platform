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

        $languages  = $this->getObject('application.languages');

        $redirect = false;
        $language = false;

        $host = 's.pol-fr.be';

        if($context->request->getFormat() == 'html')
        {
            $site = $this->getObject('application')->getSite();

            // Are we dealing with a multilingual site?
            if(count($languages) > '1')
            {
                // Do we have language information in the path?
                $language = str_replace($site, '', $path);
                $language = ltrim($language, '/');
                $language = rtrim($language, '/');

                // No language found, fallback on the browser
                if(!$language)
                {
                    foreach($this->getObject('request')->getLanguages() as $browser_language)
                    {
                        if(in_array($browser_language, $languages->slug, true))
                        {
                            // Redirect to browser language
                            $path = '/'.$site.'/'.$browser_language;
                            $language = $browser_language;
                            break;
                        }
                    }

                    $redirect = true;
                }

                // Redirect to the selected language
                if(isset($url->query['language'])) {
                    $path = '/'.$site.'/'.$url->query['language'];
                    $language = $url->query['language'];

                    $redirect = true;
                }
            }

            // Still no language, use the primary
            if(!$language)
            {
                $language = $languages->getPrimary()->slug;
                $redirect = true;
            }

            // Check if to correct domain name is used for the language
            if($return = $this->getObject('com:police.controller.language')->redirectHost($host, $language))
            {
                $host = $return;
                $redirect = true;
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