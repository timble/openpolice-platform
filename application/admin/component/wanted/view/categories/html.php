<?php
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class WantedViewCategoriesHtml extends Library\ViewHtml
{
    public function render()
    {
        $state = $this->getModel()->getState();

        $this->sections = $this->getObject('com:wanted.model.sections')->sort('ordering')->getRowset();

        return parent::render();
    }
}