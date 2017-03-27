<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class DistrictsViewDistrictHtml extends Library\ViewHtml
{
    public function render()
    {
        $model = $this->getModel();
        $district = $model->getRow();

        if(!$district->isNew())
        {
            $officers = $this->getObject('com:districts.model.districts_officers')
                ->district($district->id)
                ->getRowset()->districts_officer_id;

        } else $officers = null;

        $this->officers($officers);
        
        return parent::render();
    }
}