<?php
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Trafficinfo;
use Nooku\Library;

class DatabaseRowEvent extends Library\DatabaseRowTable
{
    public function __get($column)
    {
        if($column == 'densities' && !is_array($this->_data['densities'])) {
           $this->_data['densities'] = json_decode($this->_data['densities']);
        }
        
        if($column == 'information' && !is_array($this->_data['information'])) {
           $this->_data['information'] = json_decode($this->_data['information']);
        }

        return parent::__get($column);
    }
}