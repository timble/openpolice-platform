<?php
/**
 * Belgian Police Web Platform - Press Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class PressViewArticleHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the article
        $article = $this->getModel()->getData();

        //Get the parameters
        $this->params = $this->getObject('application')->getParams();

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem($article->title, '');

        //Get the attachments
        if ($article->id && $article->isAttachable()) {
            $this->attachments($article->getAttachments());
        }

        $published_on = new DateTime($article->published_on);
        $this->published_on = $published_on->format('c');

        return parent::render();
    }
}