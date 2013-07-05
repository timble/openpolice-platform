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
	public function streets($config = array())
	{
	    $config = new Library\ObjectConfig($config);
		$config->append(array(
			'model'     => 'streets',
            'value'		=> 'id',
            'text'		=> 'title',
			'name'		=> 'streets[]',
            'prompt'    => false
		));
		
		$config->text = 'title';
        $config->sort = 'title';
		
		return parent::_render($config);
	}
}