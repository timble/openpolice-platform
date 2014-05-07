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
    <?= import('default_scopebar.html'); ?>
    <table>
        <thead>
        <tr>
            <th width="10">
                <?= helper( 'grid.checkall'); ?>
            </th>
            <th width="20">
                <?= translate('Zone') ?>
            </th>
            <th width="10"></th>
            <th>
                <?= translate('Title') ?>
            </th>
            <th width="1">
                <?= translate('Created by') ?>
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
            <? foreach($zones as $zone): ?>
                <tr>
                    <td align="center">

                    </td>
                    <td align="center">
                        <?= $zone->zone ?>
                    </td>
                    <td>
                        <span class="label label-<?= $zone->status ?>"><?= substr($zone->status, 0, 1) ?></span>
                    </td>
                    <td style="white-space:nowrap;">
                        <a href="<?= route( 'view=zone&id='.$zone->id ); ?>">
                            <?= escape($zone->title) ?>
                        </a>
                    </td>
                    <td>
                        <?= $zone->created_by_name ?>
                    </td>
                    <td>
                        <?= helper('date.humanize', array('date' => $zone->last_activity_on)) ?> by <?= $zone->last_activity_by_name ?>
                    </td>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>
</form>