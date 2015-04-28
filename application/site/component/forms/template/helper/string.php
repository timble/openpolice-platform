<?php
/**
 * Belgian Police Web Platform - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class FormsTemplateHelperString extends Library\TemplateHelperDefault
{
    public function textarea($config = array())
    {
        $config   = new Library\ObjectConfig($config);

        $field = $config->field;
        $key = $config->key;

        $html = '<label>'.$field->label.'</label>';
        $html .= '<textarea name="text['.$key.']">Enter text here...</textarea>';

        return $html;
    }

    public function email($config = array())
    {
        $config   = new Library\ObjectConfig($config);

        $field = $config->field;
        $key = $config->key;

        $html = '<label>'.$field->label.'</label>';
        $html .= '<input type="email" name="'.$key.'" value="" />';

        return $html;
    }

    public function text($config = array())
    {
        $config   = new Library\ObjectConfig($config);

        $field = $config->field;
        $key = $config->key;

        $html = '<label>'.$field->label.'</label>';
        $html .= '<input type="text" name="text['.$key.']" value="" />';

        return $html;
    }

    public function checkbox($config = array())
    {
        $config   = new Library\ObjectConfig($config);

        $field  = $config->field;
        $key    = $config->key;

        $html = '<label>'.$field->label.'</label>';
        $html .= '<input type="checkbox" name="text['.$key.']" value="" />';

        return $html;
    }
}