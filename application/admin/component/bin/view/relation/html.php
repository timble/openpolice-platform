<?php
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class BinViewRelationHtml extends Library\ViewHtml
{
    public function render()
    {
        $model      = $this->getModel();
        $relation   = $model->getRow();

        if($relation->isLocatable() && $streets = $relation->getStreets())
        {
            $this->street = $streets->top();
        }

        return parent::render();
    }
}