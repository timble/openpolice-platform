<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;
use Nooku\Component\Pages;

class ApplicationTemplateHelperMenubar extends Pages\TemplateHelperList
{
 	/**
     * Render the menubar
     *
     * @param   array   An optional array with configuration options
     * @return  string  Html
     */
    public function render($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'attribs' => array('class' => array())
        ));

        $groups   = $this->getObject('user')->getGroups();

        // Make sure that pages without an assigned group are also included.
        $groups[] = 0;

        $result = '';

        $menus = $this->getObject('com:pages.model.menus')
            ->application('manager')
            ->getRowset();

        $menu = $menus->find(array('slug' => 'menubar'));

        if(count($menu))
        {
            $pages  = $this->getObject('application.pages')->find(array('pages_menu_id' => $menu->top()->id, 'hidden' => 0, 'users_group_id' => $groups));
            $result = $this->pages(array('pages' => $pages, 'attribs' => $config->attribs));
        }

        return $result;
    }
}
