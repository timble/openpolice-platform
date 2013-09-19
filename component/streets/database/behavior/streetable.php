<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

namespace Nooku\Component\Streets;

use Nooku\Library;

/**
 * Streetable Database Behavior
 */
class DatabaseBehaviorStreetable extends Library\DatabaseBehaviorAbstract
{
    /**
     * Get a list of streets
     *
     * @return DatabaseRowsetStreets
     */
    public function getStreets()
    {
        // $this->getTable()->getName()
        $model = $this->getObject('com:traffic.model.streets');

        if(!$this->isNew())
        {
            $streets = $model->article($this->id)->getRowset();

        } else $streets = $model->getRow();

        return $streets;
    }
}