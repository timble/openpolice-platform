<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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