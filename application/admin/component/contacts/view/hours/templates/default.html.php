<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
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
				<?= helper('grid.sort', array('column' => 'day_of_week', 'title' => 'Day')) ?>
			</th>
            <th>
                <?= helper('grid.sort', array('column' => 'day_of_week', 'title' => 'Opening time')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'day_of_week', 'title' => 'Closing time')) ?>
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
    <? $weekly = $hours->find(array('date' => '')) ?>
    <? $exceptions = $hours->find(array('date' => true)) ?>
        <? if(count($weekly)) : ?>
            <tr>
                <td colspan="5">
                    <?= translate('Weekly') ?>
                </td>
            </tr>
        <? endif ?>
        <? foreach ($weekly as $hour) : ?>
            <?= import('default_items.html', array('hour' => $hour)) ?>
		<? endforeach; ?>
        <? if(count($exceptions)) : ?>
            <tr>
                <td colspan="5">
                    <?= translate('Exceptions') ?>
                </td>
            </tr>
        <? endif ?>
        <? foreach ($exceptions as $hour) : ?>
            <?= import('default_items.html', array('hour' => $hour)) ?>
        <? endforeach; ?>
	</tbody>
	</table>
</form>