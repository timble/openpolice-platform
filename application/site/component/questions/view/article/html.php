<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class QuestionsViewArticleHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the article
        $article = $this->getModel()->getData();

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem($article->title, '');

        // Get the zone
        $this->zone = $this->getObject('com:police.model.zone')->id($this->getObject('application')->getCfg('site' ))->getRow();

        //Get the attachments
        if ($article->id && $article->isAttachable()) {
            $this->attachments($article->getAttachments());
        }

        return parent::render();
    }
}