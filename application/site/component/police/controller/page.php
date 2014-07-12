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

        $url = clone($context->request->getUrl());

        if (isset($url->query['language']) && $context->request->getFormat() == 'html')
        {
            $config = array(
                'package'   => null,
                'category'  => null,
                'language'  => $url->query['language']
            );

            $template = Library\ObjectManager::getInstance()->getObject('com:pages.view.page')->getTemplate();
            $href = $this->getObject('com:police.template.helper.string', array('template' => $template))->languages($config);

            return $this->getObject('component')->redirect($href);
        }

        return $page;
    }
}