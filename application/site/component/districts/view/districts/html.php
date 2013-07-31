<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class DistrictsViewDistrictsHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the parameters
        $params = $this->getObject('application')->getParams();

        // Get the state
        $state = $this->getModel()->getState();

        $this->params   = $params;

        setcookie ("district_street", $state->street, time()+3600*24*(2), '/5388' );
        setcookie ("district_number", $state->number, time()+3600*24*(2), '/5388' );

        return parent::render();
    }
}