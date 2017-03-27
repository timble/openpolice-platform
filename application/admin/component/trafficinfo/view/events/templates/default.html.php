<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
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
				<?= helper('grid.sort', array('column' => 'last_activity_on', 'title' => 'Activity')) ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'category')) ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'road')) ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'direction')) ?>
			</th>
			<th>
				<?= helper('grid.sort', array('column' => 'place')) ?>
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
		<? foreach ($events as $event) : ?>
		<? $information = $event->information ?>
		<tr>
			<td align="center">
				<?= helper('grid.checkbox', array('row' => $event))?>
			</td>
			<td style="white-space:nowrap;">
				<a href="<?= route( 'view=event&task=edit&id='.$event->id.'&category='.$event->categories_category_id ); ?>">
					<?= helper('date.humanize', array('date' => $event->last_activity_on)) ?> <small><?= escape($event->last_activity_by); ?></small>
				</a>
			</td>
			<td>
				<?= escape($event->category); ?>
			</td>
			<td>
				<?= escape($event->road) ?>
			</td>
			<td>
				<?= escape($event->place_direction) ?>
			</td>
			<td>
				<?= escape($event->place) ?>
			</td>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>