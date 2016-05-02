<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;

class AttachmentsViewAttachmentHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the attachment
        $attachment = $this->getModel()->getData();

        $container = $this->getObject('com:files.model.container')->slug($attachment->container)->getRow();
        $thumbnail_size = $container->parameters->thumbnail_size;

        if(is_array($thumbnail_size))
        {
            $this->aspect_ratio = $thumbnail_size['x'] / $thumbnail_size['y'];
        } else {
            $this->aspect_ratio = $thumbnail_size ? $thumbnail_size : "4/3";
        }

        return parent::render();
    }
}