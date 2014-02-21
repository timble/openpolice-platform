<?php
/**
 * Belgian Police Web Platform - HipChat Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Hipchat;

use Nooku\Library;
use Nooku\Component\Hipchat;

class ControllerBehaviorHipchattable extends Library\ControllerBehaviorAbstract
{
    protected $_body_column;

    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->_body_column = $config->body;
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'body'  => 'text'
        ));

        parent::_initialize($config);
    }

    protected function _afterControllerAdd(Library\CommandContext $context)
    {
        $entity = $context->result;

        if($entity instanceof Library\DatabaseRowAbstract && $entity->getStatus() == Library\Database::STATUS_CREATED) {
            $this->_alertHipchat($entity);
        }
    }

    protected function _alertHipchat(Library\DatabaseRowAbstract $entity)
    {
        // A HipChat message is just one big HTML text, but for ease of re-use we've split it up into a header and subject.
        $message  = $this->_getHeading($entity);
        $message .= '<br />';
        $message .= $this->_getBody($entity);

        return $this->getObject('com:hipchat.controller.message')->send(array('message' => $message, 'bgcolor' => $this->_getBackgroundColor($entity)));
    }

    protected function _getHeading(Library\DatabaseRowAbstract $entity)
    {
        $name = $entity->getIdentifier()->name;
        $user = $this->getObject('user');

        return '<strong>New ' . $name . ' by ' . $user->getName().':</strong>';
    }

    protected function _getBody(Library\DatabaseRowAbstract $entity)
    {
        return $entity->get($this->_body_column);
    }

    protected function _getBackgroundColor(Library\DatabaseRowAbstract $entity)
    {
        return Hipchat\ControllerMessage::YELLOW;
    }
}