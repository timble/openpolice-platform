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
 * Multiuserable Database Behavior
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Nooku\Component\Fora
 */
class DatabaseBehaviorMultiuserable extends Library\DatabaseBehaviorAbstract
{

    protected function _beforeTableInsert(Library\CommandContext $context)
    {
        if($this->has('created_by') && empty($this->created_by)) {
            $this->created_by = $this->getMultiUser()->id;
        }

        if($this->has('fora_user_id') && empty($this->fora_user_id))
        {
            $this->fora_user_id = $this->getMultiUser();
        }
    }

    protected function _beforeTableUpdate(Library\CommandContext $context)
    {
        if($this->has('modified_by') && empty($this->modified_by))
        {
            $this->modified_by = $this->getMultiUser()->id;
        }

        if($this->has('locked_by') && empty($this->locked_by))
        {
            $this->locked_by = $this->getMultiUser()->id;
        }


    }

    private function getMultiUser()
    {
        $fora_user = $this->getObject('com:fora.database.row.user');
        $fora_user->site = $this->getObject('application')->getSite();
        $fora_user->users_user_id = (int) $this->getObject('user')->getId();
        if($fora_user->load())
        {
            return $fora_user->id;
        }else {
            $fora_user->name = (string) $this->getObject('user')->getName();
            $fora_user->email = (string) $this->getObject('user')->getEmail();
            $fora_user->save();

        }

        return $fora_user->id;
    }

}