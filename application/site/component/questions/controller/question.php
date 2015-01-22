<?php
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class QuestionsControllerQuestion extends PoliceControllerLanguage
{
    public function getRequest()
    {
        $request = parent::getRequest();

        // Only return published items.
        $request->query->published          = 1;
        $request->query->published_category = 1;

        return $request;
    }
}
