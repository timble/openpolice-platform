<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<!--
<script src="media://js/koowa.js" />
<style src="media://css/koowa.css" />
-->

<?= @helper('behavior.sortable') ?>

<ktml:module position="toolbar">
    <?= @helper('toolbar.render', array('toolbar' => $toolbar))?>
</ktml:module>

<ktml:module position="sidebar">
    <?= @template('default_sidebar.html'); ?>
</ktml:module>

<form action="" method="get" class="-koowa-grid">
	<?= @template('default_scopebar.html'); ?>
	<table>
	<thead>
		<tr>
            <? if($sortable) : ?>
                <th class="handle"></th>
            <? endif ?>
            <th width="10">
				<?= @helper( 'grid.checkall'); ?>
			</th>
            <th width="1"></th>
			<th>
				<?= @helper('grid.sort', array('column' => 'title')) ?>
			</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="7">
				<?= @helper('com:application.paginator.pagination', array('total' => $total)) ?>
			</td>
		</tr>
	</tfoot>
	<tbody<?= $sortable ? ' class="sortable"' : '' ?>>
		<? foreach ($articles as $article) : ?>
		<tr>
            <? if($sortable) : ?>
                <td class="handle">
                    <span class="text-small data-order"><?= $article->ordering ?></span>
                </td>
            <? endif ?>
            <td align="center">
				<?= @helper('grid.checkbox', array('row' => $article))?>
			</td>
            <td align="center">
                <?= @helper('grid.enable', array('row' => $article, 'field' => 'published')) ?>
            </td>
            <td class="ellipsis">
				<a href="<?= @route( 'view=article&task=edit&id='.$article->id ); ?>">
					<?= $article->title ?>
				</a>
			</td>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>