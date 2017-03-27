<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Group Html View
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Component\Users
 */
class UsersViewGroupHtml extends Library\ViewHtml
{
    public function render()
    {
        $group = $this->getModel()->getRow();

        $this->users = $this->getObject('com:users.model.groups_users')->group_id($group->id)->getRowset()->user_id;
        
        return parent::render();
    }
}