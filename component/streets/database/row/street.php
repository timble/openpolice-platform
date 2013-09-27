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

        $islp = $this->getObject('com:streets.database.row.islp');

        //If islp is set then save the row, otherwise remove the row
        if($this->islp) {
            //Load the street
            $islp->id = $this->id;
            $islp->load();

            //Set ISLP value and save
            $islp->islp = $this->islp;
            $islp->save();
        } else {
            //Load the street and delete
            $islp->id = $this->id;
            $islp->load();
            $islp->delete();
        }

        return $result;
    }
}