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
 * Modules Html View
 *   
 * @author  Stian Didriksen <http://nooku.assembla.com/profile/stiandidriksen>
 * @package Component\Pages
 */
class PagesViewModulesHtml extends Library\ViewHtml
{
	public function render()
	{
		//Load language files for each module
	    if($this->getLayout() == 'list') 
		{
		    foreach($this->getModel()->getRowset() as $module)
		    {
                $path = Library\ClassLoader::getInstance()->getApplication($module->application);
                JFactory::getLanguage()->load($module->getIdentifier()->package, $module->name, $path );
		    }
		} 

        return parent::render();
	}
}