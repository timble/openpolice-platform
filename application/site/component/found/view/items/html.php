<?php
/**
 * Belgian Police Web Platform - Lost Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class FoundViewItemsHtml extends FoundViewHtml
{
    public function render()
    {
        //Get the parameters
        $params = $this->getObject('application')->getParams();

        $this->params   = $params;

        $this->title = JText::_('Found items');

        //Set the pathway
        if($this->getModel()->getState()->category)
        {
            $category = $this->getCategory();
            $this->getObject('application')->getPathway()->addItem($category->title, '');
            $this->title .= ' - '.$category->title;
        }

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