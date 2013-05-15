<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

namespace Nooku\Component\News;
use Nooku\Library;

class DatabaseRowArticle extends Library\DatabaseRowTable
{
    public function __get($column)
    {
        if($column == 'text' && !isset($this->_data['text'])) {
            $this->_data['text'] = $this->fulltext ? $this->introtext.'<hr id="system-readmore" />'.$this->fulltext : $this->introtext;
        }

        return parent::__get($column);
    }

    public function save()
    {
        //Set the introtext and the full text
        $text    = str_replace('<br>', '<br />', $this->text);
        $pattern = '#<hr\s+id=("|\')system-readmore("|\')\s*\/*>#i';

        if(preg_match($pattern, $text))
        {
            list($introtext, $fulltext) = preg_split($pattern, $text, 2);

            $this->introtext = trim($introtext);
            $this->fulltext = trim($fulltext);
        } else {
        	$this->introtext = trim($text);
        	$this->fulltext = '';
        }

        //Add publish_on date if not set
        if(empty($this->publish_on))
        {
            $this->publish_on = gmdate('Y-m-d H:i:s');
        }
        
        // Unpublish article if publish_on date is set to future
        if($this->publish_on > gmdate('Y-m-d H:i:s'))
        {
            $this->published = '0';
        }
        
        $result   = parent::save();

        return $result;
    }
}