<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Police;
use Nooku\Library;

class DatabaseRowZone extends Library\DatabaseRowTable
{
    public function __get($column)
    {
        $language = $this->getObject('application.languages')->getActive()->slug;

        if($column == 'title' && !isset($this->_data['title']))
        {
            $titles = json_decode($this->_data['titles'], true);

            if (is_array($titles))
            {
                if (isset($titles[$language])) {
                    $this->_data['title'] = $titles[$language];
                }
                else $this->_data['title'] = array_shift(array_values($titles));
            }
        }

        if($column == 'facebook' && !isset($this->_data['facebook']))
        {
            $items = json_decode($this->_data['social'], true);

            if (is_array($items))
            {
                if (isset($items[$language])) {
                    $this->_data['facebook'] = $items['facebook'][$language];
                }
                else $this->_data['facebook'] = array_shift(array_values($items['facebook']));
            }
        }

        if($column == 'twitter' && !isset($this->_data['twitter']))
        {
            $items = json_decode($this->_data['social'], true);

            if (is_array($items))
            {
                if (isset($items[$language])) {
                    $this->_data['twitter'] = $items['twitter'][$language];
                }
                else $this->_data['twitter'] = array_shift(array_values($items['twitter']));
            }
        }

        if($column == 'youtube' && !isset($this->_data['youtube']))
        {
            $items = json_decode($this->_data['social'], true);

            if (is_array($items))
            {
                if (isset($items[$language])) {
                    $this->_data['youtube'] = $items['youtube'][$language];
                }
                else $this->_data['youtube'] = array_shift(array_values($items['youtube']));
            }
        }

        if($column == 'instagram' && !isset($this->_data['instagram']))
        {
            $items = json_decode($this->_data['social'], true);

            if (is_array($items))
            {
                if (isset($items[$language])) {
                    $this->_data['instagram'] = $items['instagram'][$language];
                }
                else $this->_data['instagram'] = array_shift(array_values($items['instagram']));
            }
        }

        return parent::__get($column);
    }

    /**
     * Saves the zone to the database.
     *
     * @return boolean	If successfull return TRUE, otherwise FALSE
     */
    public function save()
    {
        if ($this->isModified('titles'))
        {
            $this->titles = array_filter($this->_data['titles']);
            $this->titles = json_encode($this->titles);
        }

        return parent::save();
    }
}