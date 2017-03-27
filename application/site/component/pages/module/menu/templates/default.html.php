<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? $title = $show_title ? $module->title : null; ?>

<nav role="navigation">
    <?= helper('com:pages.list.pages', array('pages' => $pages, 'active' => $active, 'title' => $title, 'attribs' => array('class' => $class))) ?>
</nav>