<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class TrafficViewArticleHtml extends Library\ViewHtml
{
    public function render()
    {
        $model      = $this->getModel();
        $article    = $model->getRow();

        if($article->isLocatable() && $streets = $article->getStreets())
        {
            $this->streets = $streets;
        }

        return parent::render();
    }
}