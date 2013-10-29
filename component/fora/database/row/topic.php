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
 * Topic Database Row
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Nooku\Component\Fora
 */
class DatabaseRowTopic extends Library\DatabaseRowTable
{
    public function save()
    {
        //Validate the title
        if(empty($this->title))
        {
            $this->_status         = Library\Database::STATUS_FAILED;
            $this->_status_message = 'Topic must have a title';

            return false;
        }

        return parent::save();
    }
}