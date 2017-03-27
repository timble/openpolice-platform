<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class SupportControllerTicket extends Library\ControllerModel
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors' => array(
                'editable',
                'broadcastable',
                'indexable',
                'com:activities.controller.behavior.loggable',
                'com:attachments.controller.behavior.attachable'
            )
        ));

        parent::_initialize($config);
    }

    public function getRequest()
    {
        $request = parent::getRequest();

        $request->query->sort           = 'last_activity_on';
        $request->query->direction      = 'DESC';

        return $request;
    }
}