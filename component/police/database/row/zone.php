<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Police;
use Nooku\Library;

class DatabaseRowZone extends Library\DatabaseRowTable
{
    public function __get($column)
    {
        if($column == 'title' && !isset($this->_data['title'])) {

            $site = $this->getObject('application')->getSite();
            $language = $this->getObject('application.languages')->getActive()->slug;

            $zone = $this->getObject('com:police.database.row.zone')->set('id', $site)->load();

            $this->_data['title'] = $zone->{'title_'.$language};
        }

        return parent::__get($column);
    }
}