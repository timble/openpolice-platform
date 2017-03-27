<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class QuestionsViewHtml extends Library\ViewHtml
{
    public function render()
    {
        $this->categories = $this->getObject('com:questions.model.categories')->published(true)->sort('title')->getRowset();

        return parent::render();
    }
}