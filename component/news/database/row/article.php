<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
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

        if($column == 'blocks' && !isset($this->_data['blocks'])) {
            $this->_data['blocks'] = json_decode($this->fulltext);
        }

        return parent::__get($column);
    }

    public function save()
    {
        //Set the introtext and the full text
        $text    = str_replace('<br>', '<br />', $this->text);
        $pattern = '#<hr\s+id=("|\')system-readmore("|\')\s*\/*>#i';

        // If created_on is modified then convert it to GMT/UTC
        if ($this->isModified('created_on') && !$this->isNew())
        {
            $this->created_on = gmdate('Y-m-d H:i:s', strtotime($this->created_on));
        }

        /*
         *  Next Generation Editor
         */
        if($this->content) {
            $blocks = $this->getObject('com:news.model.articles')->id($this->id)->getRow()->blocks;

            $this->content = htmlspecialchars($this->content, ENT_QUOTES);

            $data = array();

            // Update existing blocks
            if(count($blocks)) {
                foreach($blocks as $key => $value)
                {
                    if($key == $this->block) {
                        $data[$key]['text'] = $this->content;
                        $data[$key]['heading'] = $this->heading;
                    } else {
                        $data[$key]['text'] = $value->text;
                        $data[$key]['heading'] = $value->heading;
                    }
                }

                // Add new block
                if(max(array_keys((array) $blocks)) < $this->block) {
                    $data[$this->block]['text'] = $this->content;
                    $data[$this->block]['heading'] = $this->heading;
                }
            } else {
                // Add new block when no blocks exist
                $data[$this->block]['text'] = $this->content;
                $data[$this->block]['heading'] = $this->heading;
            }

            $this->fulltext = json_encode($data);
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