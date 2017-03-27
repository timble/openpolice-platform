<?php
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class WantedControllerArticle extends Library\ControllerModel
{
    public function getRequest()
    {
        $request = parent::getRequest();

        //Display only published items
        $request->query->published = 1;

        // No need for a hardcoded limit in JSON
        if($request->getFormat() == 'html')
        {
            $request->query->limit = '10';
        }

        $request->query->sort = 'published_on';
        $request->query->direction   = 'DESC';

        return $request;
    }
}