<?php
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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
            $options[] = $this->option(array('text' => $this->translate(ucfirst($item)), 'value' => $item));
        }

        $config->options = $options;

        return $this->optionlist($config);
    }
}