<?php
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class WantedViewArticleHtml extends  Library\ViewHtml
{
    public function render()
    {
        //Get the article
        $article = $this->getModel()->getData();

        //Get the section & category
        $section = $this->getSection();
        $category = $this->getCategory();

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem($section->title, $this->getTemplate()->getHelper('route')->category(array('row' => $section)));
        $this->getObject('application')->getPathway()->addItem($category->title, $this->getTemplate()->getHelper('route')->category(array('row' => $category)));
        $this->getObject('application')->getPathway()->addItem($article->title, '');

        $this->sections = $this->getObject('com:wanted.model.sections')->getRowset();
        $this->categories = $this->getObject('com:wanted.model.categories')->getRowset();

        $this->section = $section;
        $this->category = $category;

        return parent::render();
    }

    public function getCategory()
    {
        //Get the category
        $category = $this->getObject('com:wanted.model.categories')
            ->slug($this->getModel()->getState()->category)
            ->getRow();

        return $category;
    }

    public function getSection()
    {
        //Get the category
        $category = $this->getObject('com:wanted.model.sections')
            ->slug($this->getModel()->getState()->section)
            ->getRow();

        return $category;
    }
}