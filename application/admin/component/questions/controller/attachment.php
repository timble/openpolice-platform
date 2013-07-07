<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class QuestionsControllerAttachment extends AttachmentsControllerAttachment
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'model'   => 'com:attachments.model.attachments',
            'request' => array(
                'view' => 'attachment'
            )
        ));

        parent::_initialize($config);
    }

    public function setRedirect(Library\CommandContext $context)
    {
        $context->response->setRedirect($context->request->getReferrer());
    }
}