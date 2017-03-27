<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class QuestionsViewQuestionsHtml extends QuestionsViewHtml
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
        $category = $this->getObject('com:questions.model.categories')
            ->slug($this->getModel()->getState()->category)
            ->getRow();

        return $category;
    }
}