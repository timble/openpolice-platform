<?php
/**
 * Belgian Police Web Platform - Statistics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class StatisticsViewInteractiveHtml extends Library\ViewHtml
{
    public function render()
    {
        $languages       = $this->getObject('application.languages');
        $this->language  = $languages->getActive();

        if($this->language->slug == 'de')
        {
            $this->language->slug = 'fr';
        }

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem('Interactive', '');
        
        return parent::render();
    }
}