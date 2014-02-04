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
        $topic = $this->getModel()->getData();

        $this->forum = $this->getObject('com:fora.model.forums')->id($topic->fora_forum_id)->getRow();
        $this->fora_user = $this->getObject('com:fora.model.users')->users_user_id($this->getObject('user')->getId())->site($this->getObject('application')->getSite())->getRow();

        if($this->getObject('com:fora.model.subscriptions')->type('topic')->fora_user_id($this->fora_user->id)->row($topic->id)->getData()->row)
        {
            $this->subscription = true;
        } else $this->subscription = false;

        if(!$topic->isNew())
        {
            $vote = $this->getObject('com:fora.database.table.votes')
                ->select(array('fora_topic_id' => $topic->id, 'fora_user_id' => $this->getObject('user')->getId()), Library\Database::FETCH_ROW);
            $this->voted = !$vote->isNew();
        }

        if($this->getLayout() == 'default')
        {
            $this->comments = $this->getObject('com:fora.model.comments')->topic($topic->id)->getRowset();
        }

        return parent::render();
    }
}