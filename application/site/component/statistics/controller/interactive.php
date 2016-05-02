<?php
/**
 * Belgian Police Web Platform - Statistics Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class StatisticsControllerInteractive extends PoliceControllerPage
{
    public function _actionRender(Library\CommandContext $context)
    {
        $view  = $this->getView();
        $graph = $context->request->query->get('graph', 'cmd', false);

        $view->set('graph', $graph);

        return parent::_actionRender($context);
    }
}