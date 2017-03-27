<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Attachments;

use Nooku\Library;

/**
 * Attachable Database Behavior
 *
 * @author  Steven Rombauts <https://nooku.assembla.com/profile/stevenrombauts>
 * @package Nooku\Component\Attachments
 */
class DatabaseBehaviorAttachable extends Library\DatabaseBehaviorAbstract
{
    /**
     * Get a list of attachments
     *
     * @return RowsetAttachments
     */
    public function getAttachments()
	{
        $model = $this->getObject('com:attachments.model.attachments');

        if(!$this->isNew())
        {
            $attachments = $model->row($this->id)
                ->table($this->getTable()->getBase())
                ->getRowset();
        }
        else $attachments = $model->getRowset();

        return $attachments;
	}
}