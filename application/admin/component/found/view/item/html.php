<?php
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class FoundViewItemHtml extends Library\ViewHtml
{
    public function render()
    {
        $model      = $this->getModel();
        $item       = $model->getRow();

        if($item->isLocatable())
        {
            $this->street = $item->getStreets()->top();
        }

        return parent::render();
    }
}