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


        if($this->getObject('com:fora.model.subscriptions')->site($this->getObject('application')->getSite())->type('topic')->users_user_id($this->getObject('user')->getId())->row($topic->id)->getData()->row)
        {
            $this->subscription = true;
        } else $this->subscription = false;

        if(is_numeric($topic->id)){
            $vote = $this->getObject('com:fora.database.table.votes')
                ->select(array('fora_topic_id' => $topic->id, 'users_user_id' => $this->getObject('user')->getId()), Library\Database::FETCH_ROW);
            $this->voted = !$vote->isNew();
        }


        $this->forum = $this->getObject('com:fora.model.forums')->id($topic->fora_forum_id)->getRow();


        if($this->getLayout() !== 'form')
        {
            $this->comments = $this->getObject('com:comments.model.comments')->row($topic->id)->table('fora')->getRowset();

            if($this->forum->type != 'article' && is_numeric($topic->id))
            {
                $responds = $this->getObject('com:fora.database.table.responds')
                    ->select(array('fora_topic_id' => $topic->id), Library\Database::FETCH_ROW);

                $this->awnser =$this->getObject('com:comments.model.comments')
                    ->id($responds->comments_comment_id)
                    ->getRow();
            }

            $this->pathways =  $this->getPathway();
        }


        return parent::render();
    }

    /**
     * Return a reference to the application pathway object
     *
     * @return object ApplicationConfigPathway
     */
    public function getPathway()
    {
        if(!isset($this->pathway))
        {
            $pathway = new ForaConfigPathway();

            $pathway->addItem("Support", "categories");
            $pathway->addItem($this->forum->category_title, "category?id=".$this->forum->fora_category_id);
            $pathway->addItem($this->forum->title, 'topics?forum='.$this->forum->id.'&slug='.$this->forum->getSlug());
            $pathway->addItem($this->getModel()->getData()->title, "topic?slug=".$this->getModel()->getData()->getSlug());

        }

        return (array) $pathway->items;
    }
}