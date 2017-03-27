<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class NewsControllerArticle extends Library\ControllerModel
{
    public function getRequest()
    {
        $request = parent::getRequest();

        // Only return published items.
        $request->query->published = 1;

        // No need for a hardcoded limit in JSON
        if($request->getFormat() == 'html')
        {
            $request->query->limit = '3';
        }

        $request->query->sort = 'published_on';
        $request->query->direction   = 'DESC';

        return $request;
    }
}