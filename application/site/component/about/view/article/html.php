<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class AboutViewArticleHtml extends AboutViewHtml
{
    public function render()
    {
        //Get the article
        $article = $this->getModel()->getData();

        $category = $this->getCategory();

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem($category->title, $this->getTemplate()->getHelper('route')->category(array('row' => $category)));
        $this->getObject('application')->getPathway()->addItem($article->title, '');

        //Get the attachments
        if ($article->id && $article->isAttachable()) {
            $this->attachments($article->getAttachments());
        }

        return parent::render();
    }

    public function getCategory()
    {
        //Get the category
        $category = $this->getObject('com:categories.model.categories')
            ->table('about')
            ->slug($this->getModel()->getState()->category)
            ->getRow();

        return $category;
    }
}