<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class StreetsViewStreetHtml extends Library\ViewHtml
{
    public function render()
    {
        $model      = $this->getModel();
        $street     = $model->getRow();

        $districts = $this->getObject('com:districts.model.relations')
            ->street($street->id)
            ->number('')
            ->getRowset();

        $this->districts($districts);

        $bins = $this->getObject('com:bin.model.relations')
            ->street($street->id)
            ->number('')
            ->getRowset();

        $this->bins($bins);

        return parent::render();
    }
}