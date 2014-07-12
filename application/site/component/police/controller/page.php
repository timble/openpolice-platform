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

        $languages = $this->getObject('application.languages');

        if(count($languages) > '1')
        {
            $url    = clone($context->request->getUrl());
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
                        $href = $site.'/'.$language;
                    } else {
                        // Redirect to primary language
                        $href = $site.'/'.$languages->getActive()->slug;
                    }
                }

                $this->getObject('component')->redirect('http://'.$url->getHost().$href);
                return true;
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

                $this->getObject('component')->redirect('http://'.$url->getHost().$href);
                return true;
            }
        }

        return $page;
    }
}