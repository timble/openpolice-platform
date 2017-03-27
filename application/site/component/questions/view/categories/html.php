<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class QuestionsViewCategoriesHtml extends QuestionsViewHtml
{
    public function render()
    {
        //Get the parameters
        $this->params = $this->getObject('application')->getParams();

        // Get the zone
        $this->zone = $this->getObject('com:police.model.zone')->id($this->getObject('application')->getCfg('site'))->getRow();

        return parent::render();
    }
}