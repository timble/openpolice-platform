<?php
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class WantedViewArticleHtml extends  WantedViewHtml
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