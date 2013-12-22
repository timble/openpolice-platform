<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;

/**
 * Category Controller Toolbar
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Fora
 */
class ForaControllerToolbarCategory extends Library\ControllerToolbarActionbar
{
    /**
     * @param Library\CommandContext $context
     */
    protected function _afterControllerRead(\Nooku\Library\CommandContext $context)
    {
        parent::_afterControllerRead($context);
    }

    /**
     * @param Library\CommandContext $context
     */
    protected function _afterControllerBrowse(\Nooku\Library\CommandContext $context)
    {
        $controller = $this->getController();
        ;

        if($this->getController()->canAdd())
        {
            $identifier = $controller->getIdentifier();
            $config     = array('href' => 'option=com_'.$identifier->package.'&view='.$identifier->name."&forum=".$controller->getModel()->getState()->forum."&layout=form");

            $this->addCommand('new', $config);
        }
    }

}