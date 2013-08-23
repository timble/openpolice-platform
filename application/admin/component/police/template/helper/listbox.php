<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class PoliceTemplateHelperListbox extends Library\TemplateHelperListbox
{
    public function municipalities($config = array())
	{
		$config = new Library\ObjectConfig($config);
		$config->append(array(
			'model' 		=> 'municipalities',
			'name' 			=> 'police_municipality_id',
			'value'			=> 'id',
            'label'         => 'title'
		));
        
		return parent::_render($config);
	}
    
    public function cities($config = array())
	{
		$config = new Library\ObjectConfig($config);
		$config->append(array(
			'model' 		=> 'cities',
			'name' 			=> 'police_municipality_id',
			'value'			=> 'id',
            'label'          => 'title'
		));
        
		return parent::_render($config);
	}
	
	public function zones($config = array())
	{
		$config = new Library\ObjectConfig($config);
		$config->append(array(
			'model' 	=> 'zones',
			'name' 		=> 'police_zone_id',
			'value'		=> 'id',
            'label'     => 'title'
		));
	
		return parent::_render($config);
	}
	
	public function language($config = array())
	{
	    $config = new Library\ObjectConfig($config);
	    $config->append(array(
	        'name'      => 'language',
	        'attribs'   => array()
	    ))->append(array(
	        'selected'  => $config->{$config->name}
	    ));
	    
	    $options = array();
	    
	    $options[] = $this->option(array('text' => JText::_( 'NL' ), 'value' => '1'));
	    $options[] = $this->option(array('text' => JText::_( 'FR' ) , 'value' => '2' ));
	    $options[] = $this->option(array('text' => JText::_( 'NL & FR' ), 'value' => '3' ));
	    $options[] = $this->option(array('text' => JText::_( 'DE' ), 'value' => '4' ));
	
	    //Add the options to the config object
	    $config->options = $options;
	    
	    return $this->optionlist($config);
	}
}