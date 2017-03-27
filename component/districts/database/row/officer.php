<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Districts;
use Nooku\Library;

class DatabaseRowOfficer extends Library\DatabaseRowTable
{
    public function __get($column)
    {
        if($column == 'title' && !isset($this->_data['title'])) {
            $this->_data['title'] = $this->firstname.' '.$this->lastname;
        }

        return parent::__get($column);
    }
}
