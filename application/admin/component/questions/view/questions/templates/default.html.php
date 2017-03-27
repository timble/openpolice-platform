<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
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

<? if($questions->isTranslatable()) : ?>
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
            <? if(isset($sortable)) : ?>
                <th class="handle"></th>
            <? endif ?>
            <th width="10">
				<?= helper( 'grid.checkall'); ?>
			</th>
            <th width="1"></th>
			<th>
				<?= helper('grid.sort', array('column' => 'title')) ?>
			</th>
            <? if($questions->isTranslatable()) : ?>
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
	<tbody<?= isset($sortable) ? ' class="sortable"' : '' ?>>
		<? foreach ($questions as $question) : ?>
		<tr>
            <? if(isset($sortable)) : ?>
                <td class="handle">
                    <span class="text-small data-order"><?= $question->ordering ?></span>
                </td>
            <? endif ?>
            <td align="center">
				<?= helper('grid.checkbox', array('row' => $question))?>
			</td>
            <td align="center">
                <?= helper('grid.enable', array('row' => $question, 'field' => 'published')) ?>
            </td>
            <td class="ellipsis">
				<a href="<?= route( 'view=question&task=edit&id='.$question->id ); ?>">
					<?= $question->title ?>
				</a>
			</td>
            <? if($question->isTranslatable()) : ?>
            <td>
                <?= helper('com:languages.grid.status', array(
                    'status'   => $question->translation_status,
                    'original' => $question->translation_original,
                    'deleted'  => $question->translation_deleted));
                ?>
            </td>
            <? endif ?>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>