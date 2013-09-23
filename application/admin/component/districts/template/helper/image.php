<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
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