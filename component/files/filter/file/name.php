<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Files;

use Nooku\Library;

/**
 * File Name Filter
 *
 * @author  Ercan Ozkaya <http://nooku.assembla.com/profile/ercanozkaya>
 * @package Nooku\Component\Files
 */
class FilterFileName extends Library\FilterAbstract
{
	public function validate($row)
	{
		$value = $this->sanitize($row->name);

		if ($value == '') {
			return $this->_error(\JText::_('Invalid file name'));
		}
	}

    public function sanitize($value)
	{
		return $this->getObject('com:files.filter.path')->sanitize($value);
	}
}