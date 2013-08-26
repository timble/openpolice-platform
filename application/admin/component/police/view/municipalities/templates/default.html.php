<?
/**
 * Belgian Police Web Platform - Police Component
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
				<?= helper('grid.sort', array('column' => 'title')) ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'postcode', 'title' => 'Postcode')) ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'city_title', 'title' => 'City')) ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'police_zone_id', 'title' => 'Zone ID')) ?>
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
		<? foreach ($municipalities as $municipality) : ?>
		<tr>
			<td align="center">
				<?= helper('grid.checkbox', array('row' => $municipality))?>
			</td>
			<td>
				<a href="<?= route( 'view=municipality&task=edit&id='. $municipality->id ); ?>"><?= escape($municipality->title); ?></a>
			</td>
			<td>
				<?= escape($municipality->postcode); ?>
			</td>
			<td>
				<?= escape($municipality->city_title); ?> <?= $municipality->city_postcode ? '('.escape($municipality->city_postcode).')' : ''; ?>
			</td>
			<td>
				<?= escape($municipality->police_zone_id); ?> - <?= escape($municipality->zone_title); ?>
			</td>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>