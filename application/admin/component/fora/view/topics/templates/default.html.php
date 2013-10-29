<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<!--
<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<ktml:module position="sidebar">
    <?= import('default_sidebar.html'); ?>
</ktml:module>

<form action="" method="get" class="-koowa-grid">
    <?= import('default_scopebar.html'); ?>
    <table>
        <thead>
        <tr>
            <th width="1">
                <?= helper('grid.checkall'); ?>
            </th>
            <th width="1">

            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'title')); ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'forum_title', 'title' => 'Forum')); ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'last_activity_on', 'title' => 'Last modified')); ?>
            </th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <td colspan="20">
                <?= helper('com:application.paginator.pagination', array('total' => $total)) ?>
            </td>
        </tr>
        </tfoot>

        <tbody>
        <? foreach ($topics as $topic) : ?>
            <tr>
                <td align="center">
                    <?= helper('grid.checkbox', array('row' => $topic))?>
                </td>
                <td align="center">
                    <?= helper('grid.enable', array('row' => $topic, 'field' => 'published')) ?>
                </td>
                <td>
                    <a href="<?= route('view=topic&id='.$topic->id); ?>">
                        <?= escape($topic->title); ?>
                    </a>
                </td>
                <td>
                    <?= $topic->forum_title; ?>
                </td>
                <td>
                    <?= helper('date.humanize', array('date' => $topic->last_activity_on)) ?> <?= translate('by') ?> <?= $topic->last_activity_by_name; ?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</form>