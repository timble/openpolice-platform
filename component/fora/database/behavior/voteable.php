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

/**
 * Voteable Database Behavior
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Nooku\Component\Fora
 */
class DatabaseBehaviorVoteable extends Library\DatabaseBehaviorAbstract

{
    protected function _beforeTableInsert(Library\CommandContext $context)
    {

        if($action = $context->data->action)
        {
            $row = $this->getObject('com:fora.model.topics')->id($context->data->fora_topic_id)->getRow();

            switch($action)
            {
                case 'add':
                    $row->votes++;
                    $row->save();
                    break;

                case'delete':
                    $row->votes--;
                    $row->save();
                    break;
            }
        }
    }
}