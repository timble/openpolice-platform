<?php
/**
 * Belgian Police Web Platform - Statistics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class StatisticsViewCityHtml extends Library\ViewHtml
{
    public function render()
    {
        //Get the article
        $city = $this->getModel()->getData();

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem($city->title, '');

        $languages          = $this->getObject('application.languages');
        $this->language     = $languages->getActive();

        if($this->language->slug == 'de')
        {
            $this->language->slug = 'fr';
        }

        $this->notes = array('warning', 'abbreviations', 'description', 'context', 'definitions', 'modifications', 'explanatory note', 'pv register');

        return parent::render();
    }
}