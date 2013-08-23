<?
/**
 * Belgian Police Web Platform - Districts Component
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

<ktml:module position="toolbar">
    <ktml:toolbar type="actionbar">
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
				<?= helper('grid.sort', array('column' => 'firstname', 'title' => 'Name')) ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'district_count', 'title' => 'Districts')) ?>
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
		<? foreach ($officers as $officer) : ?>
		<tr>
			<td align="center">
				<?= helper('grid.checkbox', array('row' => $officer))?>
			</td>
			<td>
				<a href="<?= route( 'view=officer&id='. $officer->id ); ?>"><?= escape($officer->title); ?></a>
			</td>
			<td class="array-separator">
				<? foreach($districts_officers->find(array('districts_officer_id' => $officer->id)) as $officer) : ?>
					<span><?= $officer->district ?></span>
				<? endforeach; ?>
			</td>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>