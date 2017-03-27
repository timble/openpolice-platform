<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Articles Html View
 *
 * @author  Arunas Mazeika <http://nooku.assembla.com/profile/arunasmazeika>
 * @package Component\Articles
 */
class ArticlesViewArticlesHtml extends ArticlesViewHtml
{
    public function render()
    {
        //Get the parameters
        $params = $this->getObject('application')->getParams();

        //Get the category
        $category = $this->getCategory();

        //Set the pathway
        $page = $this->getObject('application.pages')->getActive();
        if($page->getLink()->query['view'] == 'categories' ) {
            $this->getObject('application')->getPathway()->addItem($category->title, '');
        }

        $this->params   = $params;
        $this->category = $category;

        return parent::render();
    }

    public function getCategory()
    {
        //Get the category
        $category = $this->getObject('com:articles.model.categories')
                         ->table('articles')
                         ->id($this->getModel()->getState()->category)
                         ->getRow();

        return $category;
    }

    public function highlight($text)
    {
        if ($searchword = $this->getModel()->getState()->searchword) {
            $text = preg_replace('/'.$searchword.'(?![^<]*?>)/i', '<span class="highlight">' . $searchword . '</span>', $text);
        }
        return $text;
    }
}