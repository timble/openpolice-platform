<?
/**
 * Belgian Police Web Platform - About Component
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
    <h3><?= translate('Categories') ?></h3>
    <?= import('com:categories.view.categories.list.html', array('categories' => object('com:categories.model.categories')->sort('title')->table('about')->getRowset())); ?>
</ktml:module>

<form action="" method="get" class="-koowa-grid">
    <?= import('default_scopebar.html'); ?>
    <table>
        <thead>
        <tr>
            <? if($sortable) : ?>
                <th class="handle"></th>
            <? endif ?>
            <th width="1">
                <?= helper('grid.checkall') ?>
            </th>
            <th width="1"></th>
            <th>
                <?= helper('grid.sort', array('column' => 'title')) ?>
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
        <tbody<?= $sortable ? ' class="sortable"' : '' ?>>
        <? foreach($articles as $article) : ?>
            <tr data-readonly="<?= $article->getStatus() == 'deleted' ? '1' : '0' ?>">
                <? if($sortable) : ?>
                    <td class="handle">
                        <span class="text-small data-order"><?= $article->ordering ?></span>
                    </td>
                <? endif ?>
                <td align="center">
                    <?= helper('grid.checkbox' , array('row' => $article)) ?>
                </td>
                <td align="center">
                    <?= helper('grid.enable', array('row' => $article, 'field' => 'published')) ?>
                </td>
                <td class="ellipsis">
                    <?if($article->getStatus() != 'deleted') : ?>
                        <a href="<?= route('view=article&id='.$article->id) ?>">
                            <?= escape($article->title) ?>
                        </a>
                    <? else : ?>
                        <?= escape($article->title); ?>
                    <? endif; ?>
                    <? if($article->access) : ?>
                        <span class="label label-important"><?= translate('Registered') ?></span>
                    <? endif; ?>
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