<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class DistrictsTemplateHelperListbox extends Library\TemplateHelperListbox
{
	public function officers( $config = array())
	{
		$config = new Library\ObjectConfig($config);
		$config->append(array(
			'identifier'    => 'com:districts.model.officers',
			'name'          => 'officers[]',
			'value'		    => 'id',
            'label'         => 'title'
		));

		return parent::_listbox($config);
	}
	
	public function districts( $config = array())
	{
		$config = new Library\ObjectConfig($config);
		$config->append(array(
			'model'  => 'districts',
			'name' 	 => 'districts_district_id',
			'value'	 => 'id',
            'label'  => 'title'
		));

		return parent::_listbox($config);
	}
	
	public function parities( $config = array())
	{
	    $config = new Library\ObjectConfig($config);
	    $config->append(array(
	        'name'      => 'range_parity',
	        'attribs'   => array(),
	        'deselect'  => true,
	        'prompt'    => '- Select -',
	    ))->append(array(
	        'selected'  => $config->{$config->name}
	    ));
	    
	    $options = array();
	    
	    $options[] = $this->option(array('label' => $this->translate( 'Odd & Even' ), 'value' => 'odd-even'));
	    $options[] = $this->option(array('label' => $this->translate( 'Odd' ) , 'value' => 'odd' ));
	    $options[] = $this->option(array('label' => $this->translate( 'Even' ), 'value' => 'even' ));
	
	    //Add the options to the config object
	    $config->options = $options;
	    
	    return $this->optionlist($config);
	}
}