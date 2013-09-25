<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class QuestionsViewQuestionHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the article
        $question = $this->getModel()->getData();

        $category = $this->getCategory($question);

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem($category->title, $this->getTemplate()->getHelper('route')->category(array('row' => $category)));
        $this->getObject('application')->getPathway()->addItem($question->title, '');

        // Get the zone
        $this->zone = $this->getObject('com:police.model.zone')->id($this->getObject('application')->getCfg('site' ))->getRow();

        //Get the attachments
        if ($question->id && $question->isAttachable()) {
            $this->attachments($question->getAttachments());
        }

        $this->categories = $this->getObject('com:questions.model.categories')->table('questions')->published(true)->sort('title')->getRowset();

        return parent::render();
    }

    public function getCategory($question)
    {
        //Get the category
        $category = $this->getObject('com:questions.model.categories')
            ->table('questions')
            ->id($question->categories_category_id)
            ->getRow();

        return $category;
    }
}