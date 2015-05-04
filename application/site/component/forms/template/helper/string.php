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
    public function element($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'element' => 'input',
            'attribs'	=> array(
                'name' => $this->getObject('lib:filter.slug')->sanitize($config->label),
                'type' => 'text',
                'value' => ''
            )
        ))->append(array(
            'attribs'	=> array(
                'id' => $config->attribs->name,
            )
        ));

        $html = '<div class="form__group">';
        $html .= $this->{$config->element}($config);
        $html .= '</div>';

        return $html;
    }

    public function input($config)
    {
        if($config->attribs->type == 'checkbox' || $config->attribs->type == 'radio')
        {
            return $this->optionlist($config);
        } else {
            $html = '<label for="'.$config->attribs->id.'">'.$this->translate($config->label).'</label>';
            $html .= '<input '.$this->buildAttributes($config->attribs).' />';

            return $html;
        }
    }

    public function textarea($config)
    {
        $html = '<label for="'.$config->attribs->id.'">'.$this->translate($config->label).'</label>';
        $html .= '<textarea '.$this->buildAttributes($config->attribs).'"></textarea>';

        return $html;
    }

    public function optionlist($config)
    {
        if($config->attribs->type == 'checkbox')
        {
            $config->attribs->name = $config->attribs->name.'[]';
        }

        $html = '<fieldset>';
        $html .= '<legend>'.$config->label.'</legend>';

        foreach($config->options as $option)
        {
            $config->attribs->id = $this->getObject('lib:filter.slug')->sanitize($option);
            $config->attribs->value = $option;

            $html .= '<div class="form__'.$config->attribs->type.'">';
            $html .= '<input '.$this->buildAttributes($config->attribs).' />';
            $html .= '<label for="'.$config->attribs->id.'">'.$this->translate($option).'</label>';
            $html .= '</div>';
        }

        $html .= '</fieldset>';

        return $html;
    }
}