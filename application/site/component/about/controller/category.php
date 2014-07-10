<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class AboutControllerCategory extends Library\ControllerModel
{
    public function getRequest()
    {
        $request = parent::getRequest();

        $request->query->published = 1;

        return $request;
    }
}