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

<? if($state->table == 'articles') : ?>
    <ktml:module position="sidebar">
        <?= import('com:categories.view.categories.default_sidebar.html'); ?>
    </ktml:module>
<? endif; ?>

<form action="" method="get" class="-koowa-grid">
    <input type="hidden" name="type" value="<?= $state->type;?>" />

    <?= import('com:categories.view.categories.default_scopebar.html'); ?>
    <table>
        <thead>
        <tr>
            <th width="1">
                <?= helper('grid.checkall'); ?>
            </th>
            <th width="1"></th>
            <th>
                <?= helper('grid.sort',  array('column' => 'title')); ?>
            </th>
            <th width="1">
                <?= helper('grid.sort',  array( 'title' => 'Articles', 'column' => 'count')); ?>
            </th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <td colspan="13">
                <?= helper('com:application.paginator.pagination', array('total' => $total)); ?>
            </td>
        </tr>
        </tfoot>

        <tbody>
        <? foreach( $categories as $category) :  ?>
            <tr>
                <td align="center">
                    <?= helper( 'grid.checkbox' , array('row' => $category)); ?>
                </td>
                <td align="center">
                    <?= helper('grid.enable', array('row' => $category, 'field' => 'published')) ?>
                </td>
                <td>
                    <a href="<?= route( 'view=category&id='.$category->id ); ?>">
                        <?= escape($category->title); ?>
                    </a>
                    <? if($category->access) : ?>
                        <span class="label label-important"><?= translate('Registered') ?></span>
                    <? endif; ?>
                </td>
                <td align="center">
                    <?= $category->count; ?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</form>
