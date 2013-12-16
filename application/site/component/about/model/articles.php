<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;
use Nooku\Component\About;

class AboutModelArticles extends About\ModelArticles
{
    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);

        $query->where('categories.published = :published')->bind(array('published' => '1'));
    }
}