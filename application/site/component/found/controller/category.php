<?php
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class FoundControllerCategory extends PoliceControllerLanguage
{
    public function getRequest()
    {
        $request = parent::getRequest();

        $request->query->published = 1;
        $request->query->sort      = 'title';

        return $request;
    }
}