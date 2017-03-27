<?php
/**
 * Belgian Police Web Platform - Statistics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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
