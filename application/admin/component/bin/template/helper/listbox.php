<?php
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class BinTemplateHelperListbox extends Library\TemplateHelperListbox
{
	public function districts( $config = array())
	{
		$config = new Library\ObjectConfig($config);
		$config->append(array(
			'model'  => 'districts',
			'name' 	 => 'bin_district_id',
			'value'	 => 'id',
            'label'  => 'title'
		));

		return parent::_listbox($config);
	}
}