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
 * Topics HTML View
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Fora
 */
class ForaViewTopicsHtml extends Library\ViewHtml
{
    public function render()
    {

        $this->forums = $this->getObject('com:fora.model.forums')->id($this->getModel()->getState()->forum)->getRow();

        if($this->getObject('com:fora.model.subscriptions')->type('forum')->user_id($this->getObject('user')->getId())->row($this->getModel()->getState()->forum)->getRow()->row)
        {
            $this->subscription = true;
        } else $this->subscription = false;

        return parent::render();
    }
}