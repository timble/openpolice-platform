<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Traffic;

use Nooku\Library;

class DatabaseRowCategory extends Library\DatabaseRowTable
{
    public function save()
    {
        // Map pages_page_id to contacts_category_id
        $pages = array(
            '19'    => '110',
            '20'    => '113',
            '21'    => '111',
            '22'    => '112'
        );

        $page = $this->getObject('com:pages.database.table.pages')->select($pages[$this->id], Library\Database::FETCH_ROW);

        // Keep Page published state in sync with the category
        if($this->published != $page->published)
        {
            $query = $this->getObject('lib:database.query.update')
                ->table(array('tbl' => $page->getTable()->getBase()))
                ->values(array('tbl.published = :published'))
                ->where('tbl.pages_page_id = :id');

            $query->bind(array(
                'id' => $page->id,
                'published' => $this->published,
            ));

            $page->getTable()->getAdapter()->update($query);
        }

        return parent::save();
    }
}
