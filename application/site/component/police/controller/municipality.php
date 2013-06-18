<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
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
                $this->getObject('application')->redirect('http://www.lokalepolitie.be/'.$municipality->police_zone_id);
                return true;
			}
		}

		return $municipality;
	}
}