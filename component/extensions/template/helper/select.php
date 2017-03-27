<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Extensions;

use Nooku\Library;

/**
 * Select Template Helper
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Extensions
 */
class TemplateHelperSelect extends Library\TemplateHelperSelect
{
	public function booleanlist( $config = array())
	{
		$config = new Library\ObjectConfig($config);
		$config->append(array(
			'name'   	=> '',
			'attribs'	=> array(),
			'true'		=> 'yes',
			'false'		=> 'no',
			'selected'	=> null,
			'translate'	=> true
		));
		
		return parent::booleanlist($config);
	}
}