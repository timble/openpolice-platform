<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Revisions;

use Nooku\Library;

/**
 * Revision Database Row
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Revisions
 */
class DatabaseRowRevision extends Library\DatabaseRowTable
{
	public function __get($column)
    {
    	if($column == 'data' && is_string($this->_data['data'])) {
			$this->_data['data'] = json_decode($this->_data['data'], true);
		}

    	return parent::__get($column);
    }

    public function setStatus($status)
    {
        if($status == 'trashed') {
            parent::setStatus(Library\Database::STATUS_DELETED);
        }

        $this->_status = $status;
        return $this;
    }
}