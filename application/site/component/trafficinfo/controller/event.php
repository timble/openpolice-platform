<?php
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class TrafficinfoControllerEvent extends Library\ControllerModel
{
    public function getRequest()
	{
		//Display only published items
		$this->_request->published = 1;
		$this->_request->sort = 'last_activity_on';
		$this->_request->direction = 'DESC';
		
		return parent::getRequest();
	}
}