<?php
/**
 * Belgian Police Web Platform - Statistics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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