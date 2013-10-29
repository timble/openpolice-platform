<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;
use Nooku\Library\CommandContext;

/**
 * Article Controller Toolbar
 *
 * @author  Johan Janssens <http://nooku.assembla.com/profile/johanjanssens>
 * @package Component\Articles
 */
class ForaControllerToolbarForum extends Library\ControllerToolbarActionbar
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        //$config->append(array('controller' => 'com:fora.controller.forum'));

        parent::_initialize($config);
    }

    protected function _afterControllerRead(Library\CommandContext $context)
    {
        parent::_afterControllerBrowse($context);

        $this->reset();
        $this->addTopic();

    }
    protected function _commandTopic(Library\ControllerToolbarCommand $command)
    {
        $controller = $this->getController();
        $forum = $controller->getModel()->getRow();
        $command->label = 'Add Topic';
        $command->href = 'option=com_fora&view=topic&layout=form&forum='.$forum->id."&category=".$forum->categories_category_id;
    }
}