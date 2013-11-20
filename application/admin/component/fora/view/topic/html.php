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
 * Forums HTML View
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Fora
 */
class ForaViewTopicHtml extends Library\ViewHtml
{
    public function render()
    {
        $this->comments = $this->getObject('com:comments.model.comments')->row($this->getModel()->getRow()->id)->table('fora')->getRowset();

        if($this->getObject('com:fora.model.subscriptions')->type('forum')->user_id($this->getObject('user')->getId())->row($this->getModel()->getState()->forum)->getRow()->row)
        {
            $this->subscription = true;
        } else $this->subscription = false;

        $vote = $this->getObject('com:fora.database.table.votes')
            ->select(array('fora_topic_id' => $this->getModel()->getRow()->id, 'user_id' => $this->getObject('user')->getId()), Library\Database::FETCH_ROW);
        $this->voted = !$vote->isNew();


        $this->forums = $this->getObject('com:fora.model.forums')->id($this->getModel()->getRow()->fora_forum_id)->getRow();

        return parent::render();
    }
}