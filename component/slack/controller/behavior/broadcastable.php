<?php
/**
 * Belgian Police Web Platform - Slack Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Slack;

use Nooku\Library;
use Nooku\Component\Slack;

class ControllerBehaviorBroadcastable extends Library\ControllerBehaviorAbstract
{
    protected function _afterControllerAdd(Library\CommandContext $context)
    {
        $entity = $context->result;

        if($entity instanceof Library\DatabaseRowAbstract && $entity->getStatus() == Library\Database::STATUS_CREATED) {
            $this->_alertSlack($entity);
        }
    }

    protected function _alertSlack(Library\DatabaseRowAbstract $entity)
    {
        $message     = $this->_getMessage($entity);
        $attachments = $this->_getAttachments($entity);

        return $this->getObject('com:slack.controller.message')->send(array('message' => $message, 'attachments' => $attachments));
    }

    protected function _getMessage(Library\DatabaseRowAbstract $entity)
    {
        $name = $entity->getIdentifier()->name;
        $user = $this->getObject('user');

        return 'New *' . $name . '* by _' . $user->getName().'_';
    }

    protected function _getAttachments(Library\DatabaseRowAbstract $entity)
    {
        return array();
    }
}