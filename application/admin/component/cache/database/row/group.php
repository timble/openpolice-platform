<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Group Database Row
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Cache
 */
 
class CacheDatabaseRowGroup extends Library\DatabaseRowAbstract
{	
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'identity_column'   => 'name'
        ));

        parent::_initialize($config);
    }
    
    public function delete()
    {
        $result = JFactory::getCache()->clean( $this->name );		    
		return $result;    
    }
}