<?php
/**
 * Belgian Police Web Platform - Lost Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class FoundViewItemHtml extends FoundViewHtml
{
    public function render()
    {
        //Get the article
        $item = $this->getModel()->getData();

        $category = $this->getCategory();

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem($category->title, $this->getTemplate()->getHelper('route')->category(array('row' => $category)));
        $this->getObject('application')->getPathway()->addItem($item->title, '');

        return parent::render();
    }

    public function getCategory()
    {
        //Get the category
        $category = $this->getObject('com:found.model.categories')
            ->slug($this->getModel()->getState()->category)
            ->getRow();

        return $category;
    }
}