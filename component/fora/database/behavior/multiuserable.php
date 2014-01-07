<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

namespace Nooku\Component\Fora;

use Nooku\Library;

/**
 * Creatable Database Behavior
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Nooku\Component\Fora
 */
class DatabaseBehaviorMultiuserable extends Library\DatabaseBehaviorAbstract
{
    /**
     * Set created information
     *
     * Requires an 'created_by_name' and 'created_by_site' column
     *
     * @return void
     */
    protected function _beforeTableInsert(Library\CommandContext $context)
    {
        $this->created_by = $this->getMultiUser()->id;

    }

    protected function _beforeTableUpdate(Library\CommandContext $context)
    {
        $this->modified_by = $this->getMultiUser()->id;
        $this->locked_by = $this->getMultiUser()->id;

    }

    private function getMultiUser()
    {
        $fora_user = $this->getObject('com:fora.database.row.user');
        $fora_user->site = $this->getObject('application')->getSite();
        $fora_user->users_user_id = (int) $this->getObject('user')->getId();
        $fora_user->name = (string) $this->getObject('user')->getName();
        $fora_user->email = (string) $this->getObject('user')->getEmail();
        if(!$fora_user->load()){
            $fora_user->save();
        }

        return $fora_user;
    }

}