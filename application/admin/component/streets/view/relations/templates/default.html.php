<?
/**
 * Belgian Police Web Platform - Streets Component
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

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<ktml:module position="sidebar">
    <?= import('default_sidebar.html'); ?>
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
				<?= helper('grid.sort', array('column' => 'street')) ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'table')) ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'row')) ?>
			</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="5">
				<?= helper('com:application.paginator.pagination', array('total' => $total)) ?>
			</td>
		</tr>
	</tfoot>
	<tbody>
		<? foreach ($relations as $relation) : ?>
		<tr>
			<td align="center">
				<?= helper('grid.checkbox', array('row' => $relation))?>
			</td>
			<td>
				<?= escape($relation->street); ?>
			</td>
			<td>
				<?= escape($relation->table); ?>
			</td>
			<td>
				<?= escape($relation->row); ?>
			</td>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>