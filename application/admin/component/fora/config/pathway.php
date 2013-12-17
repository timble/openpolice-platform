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
 * Pathway Config
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Fora
 */
class ForaConfigPathway extends Library\ObjectConfig
{
    /**
     * Add item to pathway
     *
     * @param $name
     * @param null $link
     * @return ForaConfigPathway
     */
    public function addItem($name, $link = null)
    {
        $item = new \stdClass();
        $item->name = html_entity_decode($name, ENT_COMPAT, 'UTF-8');
        $item->link = $link;

        $this->_data['items'][] = $item;

        return $this;
    }
}