<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Articles HTML View
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Component\Articles
 */
class AboutViewArticlesHtml extends Library\ViewHtml
{
    public function render()
    {
        $state = $this->getModel()->getState();

        // Enable sortable
        $this->sortable = $state->category && $state->sort == 'ordering' && $state->direction == 'asc';

        return parent::render();
    }
}