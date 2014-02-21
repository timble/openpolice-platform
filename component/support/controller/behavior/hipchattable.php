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
use Nooku\Component\Hipchat;

class ControllerBehaviorHipchattable extends Hipchat\ControllerBehaviorHipchattable
{
    protected function _getHeading(Library\DatabaseRowAbstract $entity)
    {
        $heading = parent::_getHeading($entity);
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

        return '<strong>' . $user->getName() . ' - ' . $link . '</strong>';;
    }

    protected function _getBackgroundColor(Library\DatabaseRowAbstract $entity)
    {
        $request = $this->getMixer()->getRequest();
        $name    = $entity->getIdentifier()->name;

        if($name == 'ticket') {
            return Hipchat\ControllerMessage::RED;
        }
        elseif($name == 'comment' && $request->data->status == 'solved') {
            return Hipchat\ControllerMessage::GREEN;
        }

        return Hipchat\ControllerMessage::YELLOW;;
    }
}