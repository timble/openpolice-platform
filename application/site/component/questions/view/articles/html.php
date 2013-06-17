<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class QuestionsViewArticlesHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the parameters
        $params = $this->getObject('application')->getParams();

        $this->params = $params;

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
}