<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class DistrictsViewDistrictHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the article
        $district = $this->getModel()->getData();

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem($district->title, '');

        return parent::render();
    }
}