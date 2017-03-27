<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Users;

use Nooku\Library;

/**
 * Session Database Row
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Users
 */
class DatabaseRowSession extends Library\DatabaseRowTable
{
    const LOGGED_IN  = 'logged in';
    const LOGGED_OUT = 'logged out';

    public function delete()
    {
        if($result = parent::delete()) {
            $this->setStatus(self::LOGGED_OUT);
        }

        return $result;
    }

    public function save()
    {
        $result = false;

        //@TODO : Implement automatic schema validation
        if(!empty($this->id))
        {
            if($result = parent::save())
            {
                // Hit the user last visit field
                $row = $this->getObject('com:users.database.row.user')
                            ->setData(array('email' => $this->email))
                            ->load();

                if($row)
                {
                    $row->last_visited_on = gmdate('Y-m-d H:i:s');
                    $row->save();

                    $this->setStatus(self::LOGGED_IN);
                }
            }
        }

        return $result;
    }
}