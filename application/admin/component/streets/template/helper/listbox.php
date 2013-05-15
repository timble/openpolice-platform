<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class StreetsTemplateHelperListbox extends Library\TemplateHelperListbox
{	
	public function street($config = array())
	{
	    $config = new Library\ObjectConfig($config);
		$config->append(array(
			'model'		=> 'streets',
			'name'		=> 'streets_street_id'
		));
		
		$config->text = 'title';
		
		return parent::_render($config);
	}
	
	public function streets($config = array())
	{
	    $config = new Library\ObjectConfig($config);
		$config->append(array(
			'identifier'  => 'com:streets.model.streets',
			'name'		=> 'streets[]',
			'value'		=> 'id'
		));
		
		$config->text = 'title';
		
		return parent::_render($config);
	}
}