<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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