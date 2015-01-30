<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class DistrictsViewDistrictHtml extends Library\ViewHtml
{
    public function render()
    {
        $application = $this->getObject('application');

        //Get the article
        $district = $this->getModel()->getData();
        $state = $this->getModel()->getState();

        //Set the pathway
        $application->getPathway()->addItem($district->title, '');

        // Get the zone
        $this->zone = $this->getObject('com:police.model.zone')->id($application->getCfg('site'))->getRow();

        //setcookie ("district_street", $state->street, time()+3600*24*(2), '/5388' );
        //setcookie ("district_number", $state->number, time()+3600*24*(2), '/5388' );

        $this->contact  = $this->getObject('com:contacts.model.contacts')->id($district->contacts_contact_id)->getRow();

        // Get the street
        if($this->contact->isLocatable() && $street = $this->contact->getStreets()->top())
        {
            $this->contact['street'] = $street->title_short;
            $this->contact['city'] = $street->city;
        }

        $this->site     = $this->getObject('application')->getSite();

        if($relation = $this->getObject('com:bin.model.relations')->street($state->street)->number($state->number)->getRowset()->top())
        {
            $this->bin = $this->getObject('com:bin.model.districts')->id($relation->bin_district_id)->getRow();
        }

        return parent::render();
    }
}
