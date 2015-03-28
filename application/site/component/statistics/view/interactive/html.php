<?php
/**
 * Belgian Police Web Platform - Crime Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class StatisticsViewInteractiveHtml extends Library\ViewHtml
{
    public function render()
    {
        $languages      = $this->getObject('application.languages');
        $this->language = $languages->getActive()->slug;

        //Set the pathway
        $this->getObject('application')->getPathway()->addItem('Interactive', '');

        $this->graph = isset($_GET['graph']) ? $_GET['graph'] : false;

        return parent::render();
    }
}