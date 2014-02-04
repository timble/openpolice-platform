<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

namespace Nooku\Component\Fora;

use Nooku\Library;
use Nooku\Library\CommandContext;


/**
 * Topic Controller
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Fora
 */
class ControllerTopic extends Library\ControllerModel
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors' => array(
                'editable'
            )
        ));

        parent::_initialize($config);
    }

    protected function _actionRead(CommandContext $context)
    {
        $topic = $this->getModel()->getRow();

        if($topic->isHittable()) {
            $topic->hit();
        }

        return parent::_actionRead($context);
    }

    public function getRequest()
    {
        $request = parent::getRequest();

        $request->query->sort           = 'last_activity_on';
        $request->query->direction      = 'DESC';

        return $request;
    }
}