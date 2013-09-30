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
 * Breadcrumbs Module Html View
 *
 * @author  Johan Janssens <http://nooku.assembla.com/profile/johanjanssens>
 * @package Component\Pages
 */
class NewsModuleNewsHtml extends PagesModuleDefaultHtml
{
    public function render()
    {
        $this->articles   = $this->getObject('com:news.model.articles')->sort('ordering_date')->direction('DESC')->published(true)->limit('2')->getRowset();

        return parent::render();
    }
}