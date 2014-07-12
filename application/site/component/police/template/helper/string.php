<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Police;

use Nooku\Library;

class TemplateHelperString extends Library\TemplateHelperDefault
{
    public function languages($config = array())
    {
        $languages  = $this->getObject('application.languages');
        $active     = $languages->getActive();
        $primary    = $languages->getActive();

        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'package'  => null,
            'category'  => null,
            'item'      => null,
            'language'  => $primary->slug
        ));

        $page = $this->getObject('application.pages')->getActive();
        $site = $this->getObject('application')->getCfg('site' );

        $language = $languages->find(array('slug' => $config->language))->top();

        $result = '/'.$site.'/'.$language->slug;

        if($config->package)
        {
            if($page->level == '2')
            {
                $result .= '/'.$this->getObject('com:languages.model.translations')->iso_code($language->iso_code)->table('pages')->row($page->getParentId())->getRowset()->top()->slug;
            }

            $result .= '/'.$this->getObject('com:languages.model.translations')->iso_code($language->iso_code)->table('pages')->row($page->id)->getRowset()->top()->slug;

            if($config->category && $config->package != 'contacts')
            {
                if(is_numeric($config->category))
                {
                    $result .= '/'.$this->getObject('com:languages.model.translations')->iso_code($language->iso_code)->table($config->package.'_categories')->row($config->category)->getRowset()->top()->slug;
                }
                else
                {
                    $translation = $this->getObject('com:languages.model.translations')->iso_code($active->iso_code)->table($config->package.'_categories')->slug($config->category)->getRowset()->top();
                    $result .= '/'.$this->getObject('com:languages.model.translations')->iso_code($language->iso_code)->table($config->package.'_categories')->row($translation->row)->getRowset()->top()->slug;
                }
            }

            if($config->item)
            {
                $item = $this->getObject('com:languages.model.translations')->iso_code($language->iso_code)->table($config->package)->row($config->item)->getRowset()->top();

                if($config->package == 'news' || $config->package == 'contacts')
                {
                    $result .= '/'.$item->row.'-'.$item->slug;
                }
                else
                {
                    $result .= '/'.$item->slug;
                }
            }
        }

        return $result;
    }
}