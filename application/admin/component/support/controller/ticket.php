<?php

use Nooku\Library;


class SupportControllerTicket extends Library\ControllerModel
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors' => array(
                'editable',
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