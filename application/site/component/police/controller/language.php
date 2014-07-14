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
    public function _actionBrowse(Library\CommandContext $context)
    {
        $rows = parent::_actionBrowse($context);

        $url = clone($context->request->getUrl());

        if (isset($url->query['language']) && $context->request->getFormat() == 'html' && count($this->getObject('application.languages')) > '1')
        {
            $model = $this->getModel();
            $site   = $this->getObject('application')->getSite();

            $config = array(
                'package'   => $this->getIdentifier()->package,
                'category'  => isset($model->getState()->category) ? $model->getState()->category : null,
                'language'  => $url->query['language']
            );

            $template = Library\ObjectManager::getInstance()->getObject('com:pages.view.page')->getTemplate();
            $href = $this->getObject('com:police.template.helper.string', array('template' => $template))->languages($config);

            $this->getObject('component')->redirect('http://'.$url->getHost().'/'.$site.$href);
            return true;
        }

        return $rows;
    }

    public function _actionRead(Library\CommandContext $context)
    {
        $row = parent::_actionRead($context);

        $url = clone($context->request->getUrl());

        if (isset($url->query['language']) && $context->request->getFormat() == 'html' && count($this->getObject('application.languages')) > '1')
        {
            $model = $this->getModel();
            $site   = $this->getObject('application')->getSite();

            $config = array(
                'package'   => $this->getIdentifier()->package,
                'category'  => isset($model->getState()->category) ? $model->getState()->category : null,
                'item'      => $row->id,
                'language'  => $url->query['language']
            );

            $template = Library\ObjectManager::getInstance()->getObject('com:pages.view.page')->getTemplate();
            $href = $this->getObject('com:police.template.helper.string', array('template' => $template))->languages($config);

            $this->getObject('component')->redirect('http://'.$url->getHost().'/'.$site.$href);
            return true;
        }

        return $row;
    }
}