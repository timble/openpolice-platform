<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<script src="assets://js/koowa.js" />

<style src="assets://support/css/default.css" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="get" class="-koowa-grid">
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
        <? foreach($announcements as $announcement) : ?>
            <tr>
                <td align="center">
                    <?= helper('grid.checkbox', array('row' => $announcement))?>
                </td>
                <td style="white-space:nowrap;">
                    <a href="<?= route( 'view=announcement&task=edit&id='.$announcement->id ); ?>">
                        <?= escape($announcement->title) ?>
                    </a>
                    <? if($announcement->status) : ?>
                    <span class="label label-<?= $announcement->status ?>"><?= translate($announcement->status) ?></span>
                    <? endif; ?>
                </td>
                <td>
                    <?= helper('date.humanize', array('date' => $announcement->last_activity_on)) ?> by <?= $announcement->last_activity_by_name ?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</form>