<?php
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

jimport('joomla.parameter.element');

class JElementCategories extends JElement
{
	public $_name = 'Categories';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$key_field = $node->attributes('key_field');
		$attribs = array();
		$el_name = $control_name.'['.$name.']';

		return KService::get('com:trafficinfo.template.helper.listbox')->category(array(
			'name' => $el_name,
			'value' => $key_field ? $key_field : 'slug',
			'deselect' => true,
			'showroot' => false,
			'selected' => $value,
			'attribs' => $attribs
		));
	}
}
