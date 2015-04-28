<?php
/**
 * Belgian Police Web Platform - Links Component
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
class LinksViewLinkHtml extends Library\ViewHtml
{
    public function render()
    {
        $model = $this->getModel();
        $link  = $model->getRow();

        $this->childs = $this->getObject('com:links.model.relations')->links_link_id($link->id)->getRowset();

        return parent::render();
    }
}