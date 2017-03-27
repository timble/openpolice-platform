<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Pages;

use Nooku\Library;

/**
 * Modules Database Table
 *
 * @author  Stian Didriksen <http://nooku.assembla.com/profile/stiandidriksen>
 * @package Nooku\Component\Pages
 */
class DatabaseTableModules extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors'  => array(
                'creatable', 'modifiable', 'lockable',
                'com:pages.database.behavior.orderable' => array('strategy' => 'flat'),
                'com:languages.database.behavior.translatable'
            ),
            'filters' => array(
                'content' => array('html', 'tidy'),
                'params'  => 'ini' 
            )
        ));
     
        parent::_initialize($config);
    }

	/**
	 * Get default values for all columns
	 *
	 * This method is specialized in order to set the default module position 
	 * and published state
	 * 
	 * @return  array
	 */
	public function getDefaults()
	{
		$defaults = parent::getDefaults();
		
		$defaults['position']    = 'left';
		$defaults['published']	 = 1;
		$defaults['description'] = '';
	     
		return $defaults;
	}
}