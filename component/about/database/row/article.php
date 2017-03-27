<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\About;

use Nooku\Library;

class DatabaseRowArticle extends Library\DatabaseRowTable
{
    public function __get($column)
    {
        if($column == 'text' && !isset($this->_data['text'])) {
            $this->_data['text'] = $this->fulltext ? $this->introtext.'<hr id="system-readmore" />'.$this->fulltext : $this->introtext;
        }

        if($column == 'params')
        {
            $this->_data['params'] = $this->getObject('object.config.factory')->getFormat('json')->fromString($this->_data['params']);
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
            $this->fulltext  = trim($fulltext);
        }
        else
        {
            $this->introtext = trim($text);
            $this->fulltext  = '';
        }

        //Validate the title
        if(empty($this->title))
        {
            $this->_status          = Library\Database::STATUS_FAILED;
            $this->_status_message  = JText::_('Article must have a title');

            return false;
        }

        return parent::save();
    }
}