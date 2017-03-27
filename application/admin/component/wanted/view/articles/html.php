<?php
/**
 * Belgian Police Web Platform - Wanted Component
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
class WantedViewArticlesHtml extends Library\ViewHtml
{
    public function render()
    {
        $state = $this->getModel()->getState();

        $date = new Library\Date(array('timezone' => 'GMT'));

        $this->now = $date->format('Y-m-d H:i:s');

        $this->sections = $this->getObject('com:wanted.model.sections')->sort('ordering')->getRowset();
        $this->categories = $this->getObject('com:wanted.model.categories')->sort('ordering')->getRowset();

        return parent::render();
    }
}