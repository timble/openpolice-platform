<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />

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
            <th width="1"></th>
			<th>
				<?= helper('grid.sort', array('column' => 'title', 'title' => 'Day')) ?>
			</th>
            <th>
                <?= helper('grid.sort', array('column' => 'title', 'title' => 'Opening time')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'title', 'title' => 'Closing time')) ?>
            </th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="6">
				<?= helper('com:application.paginator.pagination', array('total' => $total)) ?>
			</td>
		</tr>
	</tfoot>
	<tbody>
		<? foreach ($hours as $hour) : ?>
		<tr>
			<td align="center">
				<?= helper('grid.checkbox', array('row' => $hour))?>
			</td>
            <td align="center">
                <?= helper('grid.enable', array('row' => $hour, 'field' => 'published')) ?>
            </td>
			<td>
				<a href="<?= @route( 'view=hour&id='. $hour->id ); ?>"><?= helper('date.weekday', array('day_of_week' => $hour->day_of_week)) ?></a>
			</td>
            <td>
                <?= $hour->opening_time ?>
            </td>
            <td>
                <?= $hour->closing_time ?>
            </td>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>