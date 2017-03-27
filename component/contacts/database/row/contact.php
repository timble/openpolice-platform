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
 * @author  Isreal Canasa <http://nooku.assembla.com/profile/israelcanasa>
 * @package Nooku\Component\Contacts
 */
class DatabaseRowContact extends Library\DatabaseRowTable
{
	public function __get($column)
	{
	    if($column == 'params' && !($this->_data['params']) instanceof \JParameter)
        {
	        $file = __DIR__.'/contact.xml';

			$params	= new \JParameter($this->_data['params']);
			$params->loadSetupFile($file);

			$this->_data['params'] = $params;
        }
	    
        return parent::__get($column);
	}
	
    public function toArray()
    {
        $data = parent::toArray();

        $data['params'] = $this->params->toArray();
        return $data;
    }
}
