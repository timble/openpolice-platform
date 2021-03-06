<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Extensions;

use Nooku\Library;

/**
 * System Setting Database Row
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Extensions
 */
class DatabaseRowSetting_System extends DatabaseRowSetting
{
    /**
     * Initializes the options for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param   object  An optional Library\ObjectConfig object with configuration options.
     * @return void
     */
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
             'name' => 'system',
             'path'	=> JPATH_ROOT.'/config/config.php',
             'data' => \JFactory::getConfig()->toArray()
        ));
        
        parent::_initialize($config);
    } 
     
	/**
     * Saves the system configuration
     *
     * @return boolean  If successfull return TRUE, otherwise FALSE
     */
    public function save()
    {  
        if(!empty($this->_modified)) 
        {
            $config = new \JRegistry('config');
            $config->loadArray(\JFactory::getConfig()->toArray());
            $config->loadArray($this->_data);
            
		    if (file_put_contents($this->getPath(), $config->toString('PHP', 'config', array('class' => 'JConfig'))) === false) 
		    {
			    $this->setStatusMessage(\JText::_('ERRORCONFIGFILE'));
			    $this->setStatus(Library\Database::STATUS_FAILED);
			
			    return false;
		    }     
		
		    $this->setStatus(Library\Database::STATUS_UPDATED);
        }
        
        return true;
    }

    /**
     * The setting type
     *
     * @return string 	The setting type
     */
    public function getType()
    {
        return 'system';
    }
}