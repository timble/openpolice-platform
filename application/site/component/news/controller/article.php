<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class NewsControllerArticle extends ApplicationControllerDefault
{
    public function getRequest()
    {
        $request = parent::getRequest();

        // Only return published items.
        $request->query->published = 1;
        $request->query->limit     = '3';

        $request->query->sort = 'ordering_date';
        $request->query->direction   = 'DESC';

        return $request;
    }
}