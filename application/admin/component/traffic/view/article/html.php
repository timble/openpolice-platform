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
        $article = $this->getModel()->getRow();
        $streets = array();
        
        if($article->id){
        	foreach ($this->getObject('com:streets.model.relations')->row($article->id)->table('traffic_articles')->getRowset() as $key => $value) {
        		$streets[] = $value->streets_street_id;
        	}
        }
        
        $this->streets($streets);
        
        return parent::render();
    }
}