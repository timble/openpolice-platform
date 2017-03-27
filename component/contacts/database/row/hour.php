<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Contacts;

use Nooku\Library;

/**
 * Contact Database Row
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Nooku\Component\Contacts
 */
class DatabaseRowHour extends Library\DatabaseRowTable
{
    public function __get($column)
    {
        if($column == 'opening_time' && $this->_data['opening_time'])
        {
            $date = new Library\Date(array('date' => $this->_data['opening_time'], 'timezone' => 'UTC'));

            $this->_data['opening_time'] = $date->format('H:i');
        }

        if($column == 'closing_time' && $this->_data['closing_time'])
        {
            $date = new Library\Date(array('date' => $this->_data['closing_time'], 'timezone' => 'UTC'));

            $this->_data['closing_time'] = $date->format('H:i');
        }

        return parent::__get($column);
    }

    public function save()
    {
        if($this->date && $this->frequency == 'one-off')
        {
            $date = new Library\Date(array('date' => $this->date, 'timezone' => 'UTC'));
            $this->day_of_week = $date->format('N');
        }
        elseif($this->frequency == 'weekly')
        {
            $this->date = null;
        }

        if($this->closed == '1')
        {
            $this->opening_time = '';
            $this->closing_time = '';
            $this->appointment = NULL;
        }

        if($this->appointment == '1')
        {
            $this->opening_time = '';
            $this->closing_time = '';
        }

        $result   = parent::save();

        return $result;
    }
}
