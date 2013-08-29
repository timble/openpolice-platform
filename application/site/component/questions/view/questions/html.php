<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class QuestionsViewQuestionsHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the parameters
        $this->params = $this->getObject('application')->getParams();

        // Get the zone
        $this->zone = $this->getObject('com:police.model.zone')->id($this->getObject('application')->getCfg('site' ))->getRow();

        //Set the pathway
        if($this->getModel()->getState()->category) {
            $category = $this->getCategory();
            $this->category = $category;

            $this->params->set('page_title', $category->title);

            $this->getObject('application')->getPathway()->addItem($category->title, '');
        } else {
            $this->params->set('page_title', 'Frequently asked questions');
        }

        return parent::render();
    }

    public function highlight($text)
    {
        if ($searchword = $this->getModel()->getState()->searchword) {
            $words = explode(' ', $searchword);

            foreach($words as $word) {
                $text = preg_replace('/'.$word.'(?![^<]*?>)/i', '<span class="highlight">' . $word . '</span>', $text);
            }
        }
        return $text;
    }

    public function getCategory()
    {
        //Get the category
        $category = $this->getObject('com:categories.model.categories')
            ->table('questions')
            ->id($this->getModel()->getState()->category)
            ->getRow();

        return $category;
    }
}