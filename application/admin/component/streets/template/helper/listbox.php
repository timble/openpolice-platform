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
            'label'		=> 'title',
			'name'		=> 'streets[]',
            'prompt'    => false
		));

		return parent::_render($config);
	}

    public function cities($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'model' 		=> 'cities',
            'name' 			=> 'streets_city_id',
            'value'			=> 'id',
            'label'         => 'title'
        ));

        return parent::_render($config);
    }
}