<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

namespace Nooku\Component\Attachments;

use Nooku\Library;

/**
 * Attachment Controller
 *
 * @author  Johan Janssens <http://nooku.assembla.com/profile/johanjanssens>
 * @package Nooku\Component\Attachments
 */
class ControllerAttachment extends Library\ControllerModel
{
    protected function _actionRender(Library\CommandContext $context)
    {
        $model = $this->getModel();

        if ($model->getState()->isUnique() && $this->getRequest()->getFormat() == 'file')
        {
            $attachment = $this->getModel()->getRow();

            if (!$attachment->isNew())
            {
                $container = $this->getObject('com:files.model.containers')
                    ->slug($attachment->container)
                    ->getRow();

                $fullpath = $container->path.DS.$attachment->path;

                try
                {
                    $context->response
                        ->attachTransport('chunked')
                        ->setPath('file://'.$fullpath, 'application/force-download');
                }
                catch (InvalidArgumentException $e) {
                    throw new KControllerExceptionResourceNotFound('File not found');
                }
            }
            else throw new KControllerExceptionResourceNotFound('Attachment not found');
        }
        else parent::_actionRender($context);
    }
}