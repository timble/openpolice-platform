<?php
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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