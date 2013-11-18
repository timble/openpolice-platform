<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class PoliceControllerMunicipality extends Library\ControllerModel
{	
	public function _actionRead(Library\CommandContext $context)
	{
        $municipality = parent::_actionRead($context);

		// Redirect the user if the request doesn't include layout=form
		if ($context->request->getFormat() == 'html')
		{
			if ($municipality->police_zone_id) {
                $this->getObject('component')->redirect('http://www.lokalepolitie.be/'.$municipality->police_zone_id);
                return true;
			}
		}

		return $municipality;
	}
}