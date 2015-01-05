<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Streets;
use Nooku\Library;

class DatabaseRowStreet extends Library\DatabaseRowTable
{
    public function save() {

        $result = parent::save();

        if($this->islp) {
            $islp = $this->getObject('com:streets.database.row.streets_islps');
            $islp->id    = $this->streets_street_identifier;


            if($islp->load())
            {
                $islp->islp  = $this->islp;
                $islp->save();
            }
        }

        return $result;
    }
}