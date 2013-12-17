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
 * Forum HTML View
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Fora
 */
class ForaViewCategoryHtml extends Library\ViewHtml
{
    public function render()
    {
        $category = $this->getModel()->getData();
        $this->forums = $this->getObject('com:fora.model.forums')->category($category->id)->getRowset();

        $this->topics = $this->getObject('com:fora.model.topics')->getRowset();


        $query = $this->getObject('lib:database.query.select')
            ->columns(array(
                'fora_topic_id'         => 'fora_forum_id',
                'fora_forum_id'         => 'fora_forum_id',
                'count'       => 'COUNT(*)',
            ))
            ->table('fora_topics')
            ->group('fora_forum_id');

        $this->topics_count = $this->getObject('com:fora.database.table.topics')->select($query);

        $this->pathways =  $this->getPathway();

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
            $pathway->addItem("Home", "categories");
            $pathway->addItem($this->getModel()->getData()->title, "category?id=".$this->getModel()->getData()->id);
        }

        return (array) $pathway->items;
    }
}