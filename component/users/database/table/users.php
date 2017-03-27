<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Users;

use Nooku\Library;

/**
 * Users Database Table
 *
 * @author  Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Nooku\Component\Users
 */
class DatabaseTableUsers extends Library\DatabaseTableAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
	{
        $config->append(array(
            'name'       => 'users',
            'behaviors'  => array('modifiable', 'creatable', 'lockable', 'identifiable', 'authenticatable'),
            'column_map' => array(
                'role_id'  => 'users_role_id',
                'group_id' => 'users_group_id'
            )
        ));
		
		parent::_initialize($config);
	}
}