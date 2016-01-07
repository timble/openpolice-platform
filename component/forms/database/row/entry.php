<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Forms;
use Nooku\Library;

class DatabaseRowEntry extends Library\DatabaseRowTable
{
    public function save()
    {
        $is_valid = true;

        $text = array();
        $validation = array();

        foreach($this->_data as $key => $value)
        {
            if(!$this->getTable()->getColumn($key) && $key !== '_token')
            {
                $text[$key] = $value;
            }
        }

        $this->text = $text;

        // enable user error handling
        libxml_use_internal_errors(true);

        $html = file_get_contents('http://police.dev/5388/forms?view=form&id='.$this->_data['forms_form_id']);

        $dom = new \DOMDocument();
        $dom->loadHTML($html);

        foreach($dom->getElementsByTagName('input') as $element)
        {
            if($this->{$element->getAttribute('name')} == "")
            {
                $validation[$element->getAttribute('name')] = 'Can not be blank';
                $is_valid = false;
            }

            if($element->getAttribute('type') == 'email' && !filter_var($this->{$element->getAttribute('name')}, FILTER_VALIDATE_EMAIL))
            {
                $validation[$element->getAttribute('name')] = 'The email address is not valid';
                $is_valid = false;
            }
        }

        $this->validation = $validation;
        $this->is_valid = $is_valid;

        $result = parent::save();

        $path = $this->getObject('request')->getUrl()->getPath();
        $path = trim($path, '/');

        if($is_valid)
        {
            setcookie("forms_entry_id", "", time()-3600, $path);
        } else {
            setcookie("forms_entry_id", $this->id, time()+1200, $path);
        }

        return $result;
    }
}