<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
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
        if($column == 'opening_time')
        {
            $date = new Library\Date(array('date' => $this->_data['opening_time'], 'timezone' => 'UTC'));

            $this->_data['opening_time'] = $date->format('H:i');
        }

        if($column == 'closing_time')
        {
            $date = new Library\Date(array('date' => $this->_data['closing_time'], 'timezone' => 'UTC'));

            $this->_data['closing_time'] = $date->format('H:i');
        }

        return parent::__get($column);
    }
}
