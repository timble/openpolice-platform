<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
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

<? if($articles->isTranslatable()) : ?>
    <ktml:module position="actionbar" content="append">
        <?= helper('com:languages.listbox.languages') ?>
    </ktml:module>
<? endif ?>

<ktml:module position="sidebar">
    <?= import('default_sidebar.html'); ?>
</ktml:module>

<form action="" method="get" class="-koowa-grid">
    <?= import('default_scopebar.html'); ?>
    <table>
        <thead>
        <tr>
            <th width="1">
                <?= helper('grid.checkall') ?>
            </th>
            <th width="1"></th>
            <th width="100%">
                <?= helper('grid.sort', array('column' => 'title')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'ordering_date', 'title' => 'Published on')) ?>
            </th>
            <? if($articles->isTranslatable()) : ?>
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
        <? foreach($articles as $article) : ?>
            <tr data-readonly="<?= $article->getStatus() == 'deleted' ? '1' : '0' ?>">
                <td align="center">
                    <?= helper('grid.checkbox' , array('row' => $article)) ?>
                </td>
                <td align="center">
                    <?= helper('grid.enable', array('row' => $article, 'field' => 'published')) ?>
                </td>
                <td class="ellipsis">
                    <a href="<?= route('view=article&id='.$article->id) ?>">
                        <?= escape($article->title) ?>
                    </a>
                    <? if($article->publish_on > $now) : ?>
                        <span class="label label-warning"><?= translate('Planned') ?></span>
                    <? endif ?>
                    <? if($article->draft) : ?>
                        <span class="label label-info"><?= translate('Draft') ?></span>
                    <? endif ?>
                    <? if($article->solved) : ?>
                        <span class="label label-success"><?= translate('Solved') ?></span>
                    <? endif ?>
                </td>
                <td>
                    <? if($article->publish_on || $article->published_on) : ?>
                        <?= helper('date.format', array('date'=> $article->publish_on ? $article->publish_on : $article->published_on, 'format' => translate('DATE_FORMAT_LC5'))) ?>
                    <? endif ?>
                </td>
                <? if($article->isTranslatable()) : ?>
                <td>
                    <?= helper('com:languages.grid.status', array(
                        'status'   => $article->translation_status,
                        'original' => $article->translation_original,
                        'deleted'  => $article->translation_deleted));
                    ?>
                </td>
                <? endif ?>
            </tr>
        <? endforeach ?>
        </tbody>
    </table>
</form>