<?php
/**
 * Belgian Police Web Platform - Lost Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class FoundViewItemHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the article
        $item = $this->getModel()->getData();

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem($item->title, '');

        //Get the attachments
        if ($item->id && $item->isAttachable()) {
            $this->attachments($item->getAttachments());
        }

        // Get the street
        if($item->isLocatable() && $streets = $item->getStreets())
        {
            $item['street'] = $streets->top()->title;
        }

        return parent::render();
    }
}