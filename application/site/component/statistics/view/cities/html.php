<?php
/**
 * Belgian Police Web Platform - Statistics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class StatisticsViewCitiesHtml extends Library\ViewHtml
{
    public function render()
    {
        $languages      = $this->getObject('application.languages');
        $this->language = $languages->getActive();

        if($this->language->slug == 'de')
        {
            $this->language->slug = 'fr';
        }

        return parent::render();
    }
}
