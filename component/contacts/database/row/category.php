<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Contacts;

use Nooku\Library;

class DatabaseRowCategory extends Library\DatabaseRowTable
{
    public function save()
    {

        // Map pages_page_id to contacts_category_id
        $pages = array(
            '1'     => '42',
            '2'     => '44',
            '18'    => '66',
            '24'    => '43',
            '34'    => '105'
        );

        $row = $this->getObject('com:pages.database.row.page');
        $row->id = $pages[$this->id];

        // Keep Page published state in sync with the category
        if($row->load() && ($this->published != $row->published))
        {
            $row->published = $this->published;
            $row->save();
        }

        return parent::save();
    }
}
