<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class TrafficControllerCategory extends Library\ControllerModel
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->registerCallback('after.save'  , array($this, 'setDefaultAttachment'));
        $this->registerCallback('after.apply'  , array($this, 'setDefaultAttachment'));
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors' => array(
                'editable',
                'com:activities.controller.behavior.loggable',
                'com:attachments.controller.behavior.attachable',
                'com:languages.controller.behavior.translatable'
            )
        ));

        parent::_initialize($config);
    }

    public function setDefaultAttachment(Library\CommandContext $context)
    {
        if(!$this->isAttachable()) {
            return;
        }

        $row = $context->result;

        $attachments = $this->getObject('com:attachments.model.attachments')
            ->row($row->id)
            ->table($row->getTable()->getBase())
            ->getRowset();

        // If attachments have been linked to this row but there's no default attachment ID is still empty, set the first one as default.
        if(!$row->attachments_attachment_id && count($attachments))
        {
            $top = $attachments->top();

            $row->attachments_attachment_id = $top->id;
            $row->save();
        }

        return;
    }
}