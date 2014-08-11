<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class PoliceControllerLanguage extends Library\ControllerModel
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->_domains = array(
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
    }

    public function _actionBrowse(Library\CommandContext $context)
    {
        $rows = parent::_actionBrowse($context);

        if (isset($context->request->getUrl()->query['language']) && $context->request->getFormat() == 'html' && count($this->getObject('application.languages')) > '1')
        {
            return $this->setRedirect($context);
        }

        return $rows;
    }

    public function _actionRead(Library\CommandContext $context)
    {
        $row = parent::_actionRead($context);

        if (isset($context->request->getUrl()->query['language']) && $context->request->getFormat() == 'html' && count($this->getObject('application.languages')) > '1')
        {
            return $this->setRedirect($context, $row);
        }

        return $row;
    }

    public function setRedirect($context, $row = null)
    {
        $model = $this->getModel();

        $url    = $context->request->getUrl();
        $host   = $url->getHost();

        $site       = $this->getObject('application')->getSite();
        $package    = $this->getIdentifier()->package;
        $category   = isset($model->getState()->category) ? $model->getState()->category : null;
        $item       = isset($row) ? $row->id : null;

        $languages  = $this->getObject('application.languages');
        $active     = $languages->getActive();
        $language   = $languages->find(array('slug' => $url->query['language']))->top();

        $result = '/'.$language->slug;

        if($package)
        {
            $page = $this->getObject('application.pages')->getActive();

            if($page->level == '2')
            {
                $result .= '/'.$this->getObject('com:languages.model.translations')->iso_code($language->iso_code)->table('pages')->row($page->getParentId())->getRowset()->top()->slug;
            }

            $result .= '/'.$this->getObject('com:languages.model.translations')->iso_code($language->iso_code)->table('pages')->row($page->id)->getRowset()->top()->slug;

            if($category && $package != 'contacts')
            {
                if(is_numeric($category))
                {
                    $result .= '/'.$this->getObject('com:languages.model.translations')->iso_code($language->iso_code)->table($package.'_categories')->row($category)->getRowset()->top()->slug;
                }
                else
                {
                    $current = $this->getObject('com:languages.model.translations')->iso_code($active->iso_code)->table($package.'_categories')->slug($category)->getRowset()->top();
                    $result .= '/'.$this->getObject('com:languages.model.translations')->iso_code($language->iso_code)->table($package.'_categories')->row($current->row)->getRowset()->top()->slug;
                }
            }

            if($item)
            {
                $item = $this->getObject('com:languages.model.translations')->iso_code($language->iso_code)->table($package)->row($item)->getRowset()->top();

                if($package == 'news' || $package == 'contacts')
                {
                    $result .= '/'.$item->row.'-'.$item->slug;
                }
                else
                {
                    $result .= '/'.$item->slug;
                }
            }
        }

        if($return = $this->redirectHost($host, $language->slug, $languages))
        {
            $host = $return;
        }

        $url = 'http://'.$host.'/'.$site.$result;

        $this->getObject('component')->redirect($url);
        return true;
    }

    public function redirectHost($host, $language, $languages)
    {
        // Make sure we are using the proper domain name
        if(array_key_exists($host, $this->_domains) && count($languages) == '1')
        {
            if($this->_domains[$host]['language'] != $language)
            {
                $needle = array('language' => $language, 'access' => $this->_domains[$host]['access']);

                return array_search($needle, $this->_domains);
            }
        }

        return false;
    }
}