<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;

/**
 * Forum Controller Permission
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Fora
 */
class ForaControllerPermissionTopic extends ApplicationControllerPermissionAbstract
{
    public function canRead()
    {
        $result  = true;
        $topic = $this->getModel()->getRow();

        if (!$topic->isNew())
        {
            // Only published articles can be read. An exception is made for editors and above.
            if ($topic->published == 0 && !$this->canEdit()) {
                $result = false;
            }

            // Users can read their own articles regardless of the state
            if ($topic->created_by == $this->getUser()->getId()) {
                $result = true;
            }
        }

        return $result;
    }

}