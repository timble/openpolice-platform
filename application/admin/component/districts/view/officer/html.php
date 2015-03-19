<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class DistrictsViewOfficerHtml extends Library\ViewHtml
{
    public function render()
    {
        $model      = $this->getModel();
        $officer    = $model->getRow();

        if(!$officer->districts_officer_id)
        {
            $districts = $this->getObject('com:districts.model.districts_officers')
                ->officer($officer->id)
                ->getRowset();

        } else $districts = null;

        $this->districts($districts);

        return parent::render();
    }
}