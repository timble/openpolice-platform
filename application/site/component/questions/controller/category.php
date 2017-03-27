<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class QuestionsControllerCategory extends Library\ControllerModel
{
    public function getRequest()
    {
        $request = parent::getRequest();

        $request->query->published = 1;

        return $request;
    }
}
