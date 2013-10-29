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
class ForaViewForumsHtml extends Library\ViewHtml
{
    public function render()
    {
        $state = $this->getModel()->getState();

        // Enable sortable
        $this->sortable = $state->category && $state->sort == 'ordering' && $state->direction == 'asc';

        return parent::render();
    }
}