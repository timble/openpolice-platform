<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
use Nooku\Library;

class TrafficViewArticleHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the contact
        $article = $this->getModel()->getData();

        //Set the pathway
		$this->getObject('application')->getPathway()->addItem($article->title, '');

		$this->streets = $this->getObject('com:streets.model.relations')->row($article->id)->table('traffic_articles')->getRowset();

        return parent::render();
    }
}