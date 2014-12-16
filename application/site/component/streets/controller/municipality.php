<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class StreetsControllerMunicipality extends Library\ControllerModel
{
    public function _actionBrowse(Library\CommandContext $context)
    {
        $municipalities = parent::_actionBrowse($context);

        // Redirect the user if the request doesn't include layout=form
        if ($context->request->getFormat() == 'html' && count($municipalities) == '1')
        {
            $municipality = $municipalities->top();

            if ($municipality->police_zone_id) {
                $url    = $this->getObject('application')->getRequest()->getUrl();
                $host   = $url->getHost();

                $this->getObject('component')->redirect('http://'.$host.'/'.$municipality->police_zone_id);
                return true;
            }
        }

        return $municipalities;
    }
}