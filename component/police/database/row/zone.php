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
        if($column == 'title' && !isset($this->_data['title']))
        {
            $language = $this->getObject('application.languages')->getActive()->slug;

            $titles = json_decode($this->_data['titles'], true);

            if (is_array($titles))
            {
                if (isset($titles[$language])) {
                    $this->_data['title'] = $titles[$language];
                }
                else $this->_data['title'] = array_shift(array_values($titles));
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