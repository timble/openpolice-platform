<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class QuestionsControllerQuestion extends Library\ControllerModel
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
            ),
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
            foreach($attachments as $attachment) {
                // Make sure the attachment is an image
                if($attachment->file->isImage()) {
                    $row->attachments_attachment_id = $attachment->id;
                    $row->save();

                    break;
                }
            }
        }

        return;
    }
}