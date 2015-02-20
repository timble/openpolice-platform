<?php
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
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

        $this->sections = $this->getObject('com:wanted.model.sections')->sort('ordering')->getRowset();
        $this->categories = $this->getObject('com:wanted.model.categories')->sort('ordering')->getRowset();

        return parent::render();
    }
}