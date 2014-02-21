<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Support;

use Nooku\Library;

class ControllerBehaviorChattable extends Library\DatabaseBehaviorAbstract
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
        $message  = $this->_getHeader($entity);
        $message .= '<br />';
        $message .= $this->_getBody($entity);

        $color = $entity->getIdentifier()->name == 'ticket' ? 'yellow' : 'green';

        return $this->getObject('com:hipchat.controller.message')->send(array('message' => $message, 'bgcolor' => $color));
    }

    protected function _getHeader(Library\DatabaseRowAbstract $entity)
    {
        $name = $entity->getIdentifier()->name;

        $user = $this->getObject('user');
        $ticket = $name == 'ticket' ? $entity : $this->getObject('com:support.model.tickets')->id($entity->row)->getRow();

        // Create the route to the topic
        $parts = array(
            'view'   => 'ticket',
            'option' => 'com_support',
            'id'     => ($name == 'ticket' ? $entity->id : $entity->row)
        );

        $host = $this->getObject('request')->getBaseUrl()->toString(Library\HttpUrl::SCHEME | Library\HttpUrl::HOST);
        $path = $this->getObject('lib:dispatcher.router.route', array(
            'url'    => '?'.http_build_query($parts),
            'escape' => true
        ));

        $url  = $host.$path;
        $link = '<a href="'.$url.'">' . $ticket->title . '</a>';

        // Now build the heading string
        $heading = '';
        if($name == 'comment') {
            $heading = '<strong>New comment from ' . $user->getName().' to ticket '.$link.':</strong>';
        }
        else $heading = '<strong>New ticket '.$link.' by ' . $user->getName().':</strong>';

        return $heading;
    }

    protected function _getBody(Library\DatabaseRowAbstract $entity)
    {
        return $entity->get($this->_body_column);
    }
}