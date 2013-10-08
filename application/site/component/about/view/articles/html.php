<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class AboutViewArticlesHtml extends AboutViewHtml
{
    public function render()
    {
        //Get the parameters
        $this->params = $this->getObject('application')->getParams();

        //Set the pathway
        if($this->getModel()->getState()->category) {
            $category = $this->getCategory();
            $this->category = $category;

            $this->params->set('page_title', $category->title);

            $this->getObject('application')->getPathway()->addItem($category->title, '');
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