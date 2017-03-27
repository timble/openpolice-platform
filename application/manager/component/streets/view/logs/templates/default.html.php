<?
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<!--
<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />
-->

<form action="" method="get" class="-koowa-grid">
	<?= import('default_scopebar.html'); ?>
	<table>
	<thead>
		<tr>
			<th>
				<?= helper('grid.sort', array('column' => 'name')) ?>
			</th>
            <th>
                <?= helper('grid.sort', array('column' => 'type')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'action')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'row', 'title' => 'Row')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'created_on', 'title' => 'Created on')) ?>
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
		<? foreach ($logs as $log) : ?>
		<tr>
			<td>
				<? if($log->action == 'edit') : ?>
                <a href="<?= route( 'view=log&task=edit&id='. $log->id ); ?>"><?= escape($log->name); ?></a>
                <? else : ?>
                <?= escape($log->name); ?>
                <? endif ?>
			</td>
            <td>
                <?= $log->type ?>
            </td>
            <td>
                <?= $log->action ?>
            </td>
            <td>
                <?= $log->row ?>
            </td>
            <td>
                <? if($log->created_on) : ?>
                <?= helper('date.format', array('date'=> $log->created_on, 'format' => 'D d/m/Y H:i:s')) ?>
                <? endif ?>
            </td>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>