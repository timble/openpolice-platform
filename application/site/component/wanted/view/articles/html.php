<?php
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class WantedViewArticlesHtml extends  Library\ViewHtml
{
    public function render()
    {
        //Get the parameters
        $this->params = $this->getObject('application')->getParams();

        //Set the pathway
        if($this->getModel()->getState()->section && !$this->getModel()->getState()->category)
        {
            $section = $this->getSection();

            $this->getObject('application')->getPathway()->addItem($section->title, '');

            $this->title    = $section->title;
        }

        //Set the pathway
        if($this->getModel()->getState()->category)
        {
            $section = $this->getSection();
            $category = $this->getCategory();

            $this->getObject('application')->getPathway()->addItem($section->title, $this->getTemplate()->getHelper('route')->category(array('row' => $section)));
            $this->getObject('application')->getPathway()->addItem($category->title, '');

            $this->title    = $section->title.' - '.$category->title;
        }

        $this->sections = $this->getObject('com:wanted.model.sections')->getRowset();
        $this->categories = $this->getObject('com:wanted.model.categories')->getRowset();

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