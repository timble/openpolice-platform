<?php
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class TrafficinfoTemplateHelperListbox extends Library\TemplateHelperListbox
{	
	public function items($config = array())
	{
	    $config = new Library\ObjectConfig($config);
		$config->append(array(
			'model'		=> 'items',
            'label'     => 'title'
		));
		
		return parent::_render($config);
	}
	
	public function groups(array $config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'name'     => 'group',
            'deselect' => false,
        ));

        if($config->deselect) {
            $options[] = $this->option(array('text' => $config->prompt, 'value' => ''));
        }

        $list = array('incident','situation','traffic','source','roads','places','text');

        foreach($list as $item) {
            $options[] = $this->option(array('text' => JText::_(ucfirst($item)), 'value' => $item));
        }

        $config->options = $options;

        return $this->optionlist($config);
    }
}