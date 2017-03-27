<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class PoliceTemplateHelperListbox extends Library\TemplateHelperListbox
{
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
	    
	    $options[] = $this->option(array('label' => $this->translate( 'Dutch' ), 'value' => '1'));
	    $options[] = $this->option(array('label' => $this->translate( 'French' ) , 'value' => '2' ));
	    $options[] = $this->option(array('label' => $this->translate( 'Dutch & French' ), 'value' => '3' ));
	    $options[] = $this->option(array('label' => $this->translate( 'German' ), 'value' => '4' ));
	    $options[] = $this->option(array('label' => $this->translate( 'Dutch, French & German' ), 'value' => '7' ));

	    //Add the options to the config object
	    $config->options = $options;
	    
	    return $this->optionlist($config);
	}

    public function platform($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'name'      => 'platform',
            'attribs'   => array(),
            'prompt'    => 'External'
        ))->append(array(
            'selected'  => $config->{$config->name}
        ));

        $options = array();

        if($config->deselect) {
            $options[] = $this->option(array('label' => $this->translate($config->prompt)));
        }

        $options[] = $this->option(array('label' => '1', 'value' => '1'));
        $options[] = $this->option(array('label' => '2', 'value' => '2' ));

        //Add the options to the config object
        $config->options = $options;

        return $this->optionlist($config);
    }
}