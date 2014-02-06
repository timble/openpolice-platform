<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<style src="assets://fora/css/default.css" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<ktml:module position="sidebar">
    <?= import('default_sidebar.html', array('forums' => $forums)); ?>
</ktml:module>

<form action="" method="get" class="-koowa-grid">
    <?= import('default_scopebar.html'); ?>
    <table>
        <thead>
        <tr>
            <th width="10">
                <?= helper( 'grid.checkall'); ?>
            </th>
            <th>
                <?= translate('Title') ?>
            </th>
            <th width="1">
                <?= translate('Last activity') ?>
            </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="7">
                <?= helper('com:application.paginator.pagination', array('total' => $total)) ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <? foreach($topics as $topic) : ?>
            <tr>
                <td align="center">
                    <?= helper('grid.checkbox', array('row' => $topic))?>
                </td>
                <td style="white-space:nowrap;">
                    <a href="<?= route( 'view=topic&task=edit&id='.$topic->id ); ?>">
                        <?= escape($topic->title) ?>
                    </a>
                    <? if($topic->status) : ?>
                    <span class="label label-<?= $topic->status ?>"><?= translate($topic->status) ?></span>
                    <? endif; ?>
                </td>
                <td>
                    <?= helper('date.humanize', array('date' => $topic->last_activity_on)) ?> by <?= $topic->last_activity_by_name ?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</form>