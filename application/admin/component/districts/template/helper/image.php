<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class DistrictsTemplateHelperImage extends Library\TemplateHelperImage
{ 
	public function listbox($config = array())
	{
  		$config = new Library\ObjectConfig($config);
  		$config->append(array(
   			'selected' => 'placeholder.png'
  		));  
			
		return parent::listbox($config);
 	}
}