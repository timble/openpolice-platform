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
			<th width="10">
				<?= @helper( 'grid.checkall'); ?>
			</th>
			<th>
				<?= @helper('grid.sort', array('column' => 'last_activity_on', 'title' => 'Activity')) ?>
			</th>
			<th>
				<?= @helper('grid.sort', array('column' => 'category')) ?>
			</th>
			<th>
				<?= @helper('grid.sort', array('column' => 'road')) ?>
			</th>
			<th>
				<?= @helper('grid.sort', array('column' => 'direction')) ?>
			</th>
			<th>
				<?= @helper('grid.sort', array('column' => 'place')) ?>
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
	<tbody>
		<? foreach ($events as $event) : ?>
		<? $information = $event->information ?>
		<tr>
			<td align="center">
				<?= @helper('grid.checkbox', array('row' => $event))?>
			</td>
			<td style="white-space:nowrap;">
				<a href="<?= @route( 'view=event&task=edit&id='.$event->id.'&category='.$event->categories_category_id ); ?>">
					<?= @helper('date.humanize', array('date' => $event->last_activity_on)) ?> <small><?= @escape($event->last_activity_by); ?></small>
				</a>
			</td>
			<td>
				<?= @escape($event->category); ?>
			</td>
			<td>
				<?= @escape($event->road) ?>
			</td>
			<td>
				<?= @escape($event->place_direction) ?>
			</td>
			<td>
				<?= @escape($event->place) ?>
			</td>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>