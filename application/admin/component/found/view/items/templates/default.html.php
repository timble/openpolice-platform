<?
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<!--
<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<? if($items->isTranslatable()) : ?>
    <ktml:module position="actionbar" content="append">
        <?= helper('com:languages.listbox.languages') ?>
    </ktml:module>
<? endif ?>

<form action="" method="get" class="-koowa-grid">
    <?= import('default_scopebar.html'); ?>
    <table>
        <thead>
        <tr>
            <th width="10">
                <?= helper( 'grid.checkall'); ?>
            </th>
            <th width="1"></th>
            <th width="100%">
                <?= helper('grid.sort', array('column' => 'title')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'found_on', 'title' => 'Found on')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'tracking_number', 'title' => 'Tracking number')) ?>
            </th>
            <? if($items->isTranslatable()) : ?>
                <th width="70">
                    <?= translate('Translation') ?>
                </th>
            <? endif ?>
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
        <? foreach ($items as $item) : ?>
            <tr>
                <td align="center">
                    <?= helper('grid.checkbox', array('row' => $item))?>
                </td>
                <td align="center">
                    <?= helper('grid.enable', array('row' => $item, 'field' => 'published')) ?>
                </td>
                <td class="ellipsis">
                    <a href="<?= route( 'view=item&task=edit&id='.$item->id ); ?>">
                        <?= escape($item->title) ?>
                    </a>
                </td>
                <td>
                    <?= helper('date.format', array('date'=> $item->found_on, 'format' => translate('DATE_FORMAT_LC4'))) ?>
                </td>
                <td>
                    <?= $item->tracking_number ?>
                </td>
                <? if($item->isTranslatable()) : ?>
                    <td>
                        <?= helper('com:languages.grid.status', array(
                            'status'   => $item->translation_status,
                            'original' => $item->translation_original,
                            'deleted'  => $item->translation_deleted));
                        ?>
                    </td>
                <? endif ?>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</form>