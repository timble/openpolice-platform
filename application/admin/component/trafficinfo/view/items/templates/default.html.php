<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
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
    <?= include('default_sidebar.html'); ?>
</ktml:module>

<form action="" method="get" class="-koowa-grid">
	<?= include('default_scopebar.html'); ?>
	<table>
	<thead>
		<tr>
			<th width="10">
				<?= helper( 'grid.checkall'); ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'title', 'title' => 'Title NL')) ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'title_fr', 'title' => 'Title FR')) ?>
			</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="4">
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
			<td>
				<a href="<?= route( 'view=item&task=edit&id='. $item->id ); ?>"><?= escape($item->title); ?></a>
			</td>
			<td>
				<?= escape($item->title_fr); ?>
			</td>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>