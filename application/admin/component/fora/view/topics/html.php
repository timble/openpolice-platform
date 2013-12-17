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

        $this->forum = $this->getObject('com:fora.model.forums')->id($this->getModel()->getState()->forum)->getRow();

        if($this->getObject('com:fora.model.subscriptions')->site($this->getObject('application')->getSite())->type('forum')->users_user_id($this->getObject('user')->getId())->row($this->forum->id)->getData()->row)
        {
            $this->subscription = true;
        } else $this->subscription = false;

        $this->pathways = $this->getPathway();

        return parent::render();
    }

    /**
     * Return a reference to the application pathway object
     *
     * @return object ApplicationConfigPathway
     */
    public function getPathway()
    {
        if(!isset($this->_pathway))
        {
            $pathway = new ForaConfigPathway();
            $pathway->addItem("Support", "categories");
            $pathway->addItem($this->forum->category_title, "category?id=".$this->forum->categories_category_id);
            $pathway->addItem($this->forum->title, "topics?forum=".$this->forum->id);
        }

        return (array) $pathway->items;
    }
}