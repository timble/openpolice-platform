<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<!--
<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />
-->
<?= helper('behavior.sortable') ?>

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<? if($sections->isTranslatable()) : ?>
    <ktml:module position="actionbar" content="append">
        <?= helper('com:languages.listbox.languages') ?>
    </ktml:module>
<? endif ?>

<form action="" method="get" class="-koowa-grid">
    <?= import('default_scopebar.html'); ?>
    <table>
        <thead>
        <tr>
            <th width="1">
                <?= helper('grid.checkall') ?>
            </th>
            <th width="1"></th>
            <th>
                <?= helper('grid.sort', array('column' => 'title')) ?>
            </th>
            <? if($sections->isTranslatable()) : ?>
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
        <? foreach($sections as $section) : ?>
            <tr>
                <td align="center">
                    <?= helper('grid.checkbox' , array('row' => $section)) ?>
                </td>
                <td align="center">
                    <?= helper('grid.enable', array('row' => $section, 'field' => 'published')) ?>
                </td>
                <td class="ellipsis">
                    <a href="<?= route('view=section&id='.$section->id) ?>">
                        <?= escape($section->title) ?>
                    </a>
                </td>
                <? if($section->isTranslatable()) : ?>
                    <td>
                        <?= helper('com:languages.grid.status', array(
                            'status'   => $section->translation_status,
                            'original' => $section->translation_original,
                            'deleted'  => $section->translation_deleted));
                        ?>
                    </td>
                <? endif ?>
            </tr>
        <? endforeach ?>
        </tbody>
    </table>
</form>