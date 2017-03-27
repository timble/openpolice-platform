<?php
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class TrafficinfoTemplateHelperString extends Library\TemplateHelperAbstract
{
	public function title($config = array())
	{
		$config = new Library\ObjectConfig($config);
		$config->append(array(
			'row'      => ''
		));
	
		$row  = $config->row;
		
		switch ($row->trafficinfo_category_id) {
		    case 3: // Ghost
		        $output = $row->category;
		        break;
		    case 4: // Density
		        $output = $row->category;
		        break;
		    case 5: // Actua
		        $output = $row->title;
		        break;
		    default: //default
		    	$output = $row->incident;
		}
	
		return $output;
	}
	
	public function location($config = array())
	{
		$config = new Library\ObjectConfig($config);
		$config->append(array(
			'row'      => ''
		));
	
		$row  = $config->row;
		
		if($row->road) {
			$output = $this->translate('On the').' '.'<strong>'.$row->road.'</strong>';
			
			if($row->road_bis) {
				$output .= ' ('.$row->road_bis.')';
			}
			if($row->direction) {
				$output .= ' '.$this->translate('in the direction of').' '.'<strong>'.$row->direction.'</strong>';
			}
				
			if($row->jams_place_id) {
				$output .= ' '.$this->translate('at the level of').' '.'<strong>'.$row->place.'</strong>';
			}
			
			return $output;
		}
		
		return false;
	}
	
	public function info($config = array())
	{
		$config = new Library\ObjectConfig($config);
		$config->append(array(
			'row'      => ''
		));
	
		$row  = $config->row;
		
		$output = '';
		
		if($row->traffic || $row->situation) {
			
			if($row->trafficinfo_category_id == '1' OR $row->trafficinfo_category_id == '2') {
				
				if($row->traffic) {
					$output .= $row->traffic;
				}
				
				if($row->traffic && $row->situation) {
					$output .= ' - ';
				}
				
				if($row->situation) {
					$output .= $row->situation;
				}
			}
			
			return $output;
		}
		
		return false;
	}
	
	public function details($config = array())
	{
		$config = new Library\ObjectConfig($config);
		$config->append(array(
			'row'      => ''
		));
	
		$row  = $config->row;
		$information = $row->information;
		
		if ($row->place_end OR $information->jam_length OR $information->jam_time) {
			$output = $this->translate('Jam').' ';
			
			if($row->place && $row->place_end) {
				$output .= $this->translate('from').' '.$row->place.' ';
			}
			
			if($row->place_end) {
				$output .= $this->translate('till').' '.$row->place_end;
			}
			
			if($row->place_end && $information->jam_length) {
				$output .= ' - ';
			}
			
			if($information->jam_length) {
				$output .= $information->jam_length.' '.$this->translate('km').' file';
			}
			
			if(($row->place_end OR $information->jam_length) && $information->jam_time) {
				$output .= ' - ';
			}
			
			if($information->jam_time) {
				$output .= $information->jam_time.' '.$this->translate('minutes').' '.$this->translate('delay');
			}
			
			return $output;
		}
		
		return false;	
	}
}
