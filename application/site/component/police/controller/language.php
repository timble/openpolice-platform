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
            'www.lokalepolitie.be'      => array('language' => 'nl', 'access' => 'live'),
            'www.policelocale.be'       => array('language' => 'fr', 'access' => 'live'),
            'www.lokalepolizei.be'      => array('language' => 'de', 'access' => 'live'),
            'new.lokalepolitie.be'      => array('language' => 'nl', 'access' => 'production'),
            'new.policelocale.be'       => array('language' => 'fr', 'access' => 'production'),
            'new.lokalepolizei.be'      => array('language' => 'de', 'access' => 'production'),
            'staging.lokalepolitie.be'  => array('language' => 'nl', 'access' => 'staging'),
            'staging.policelocale.be'   => array('language' => 'fr', 'access' => 'staging'),
            'staging.lokalepolizei.be'  => array('language' => 'de', 'access' => 'staging'),
        );

        $this->registerCallback('before.read'   , array($this, 'checkHost'));
        $this->registerCallback('before.browse' , array($this, 'checkHost'));
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
        $section    = isset($model->getState()->section) ? $model->getState()->section : null;
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

            if($section && $package == 'wanted')
            {
                $current = $this->getObject('com:languages.model.translations')->iso_code($active->iso_code)->table($package.'_sections')->slug($section)->getRowset()->top();
                $result .= '/'.$this->getObject('com:languages.model.translations')->iso_code($language->iso_code)->table($package.'_sections')->row($current->row)->getRowset()->top()->slug;
            }

            if($category && !in_array($package, array('contacts', 'traffic')))
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
                if($package == 'districts')
                {
                    $item = $this->getObject('com:districts.model.districts')->id($item)->getRowset()->top();
                } else {
                    $item = $this->getObject('com:languages.model.translations')->iso_code($language->iso_code)->table($package)->row($item)->getRowset()->top();
                }

                if(in_array($package, array('contacts', 'news', 'traffic', 'wanted', 'press')))
                {
                    $result .= '/'.$item->row.'-'.$item->slug;
                }
                else
                {
                    $result .= '/'.$item->slug;
                }
            }
        }

        if($return = $this->findHost($host, $language->slug))
        {
            $host = $return;
        }

        $url = 'http://'.$host.'/'.$site.$result;

        $this->getObject('component')->redirect($url);
        return true;
    }

    public function checkHost($context)
    {
        $url    = $context->request->getUrl();
        $host   = $url->getHost();
        $path   = $url->getPath();

        $languages  = $this->getObject('application.languages');
        $active     = $languages->getActive();

        // Check if host and language are in sync
        if($return = $this->findHost($host, $active->slug))
        {
            $this->getObject('component')->redirect('http://'.$return.$path);

            return true;
        }
    }

    public function findHost($host, $language)
    {
        // Make sure the given host exists
        if(array_key_exists($host, $this->_domains))
        {
            // Check if host and language are in sync
            if($this->_domains[$host]['language'] != $language)
            {
                $needle = array('language' => $language, 'access' => $this->_domains[$host]['access']);

                return array_search($needle, $this->_domains);
            }
        }

        return false;
    }
}