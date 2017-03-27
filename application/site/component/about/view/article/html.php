<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
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

        $this->url  = $this->getObject('application')->getRequest()->getUrl()->toString(Library\HttpUrl::HOST);
        $this->zone = $this->getObject('com:police.model.zone')->id($this->getObject('application')->getSite())->getRow();

        return parent::render();
    }

    public function getCategory()
    {
        //Get the category
        $category = $this->getObject('com:about.model.categories')
            ->slug($this->getModel()->getState()->category)
            ->getRow();

        return $category;
    }
}