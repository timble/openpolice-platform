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
<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />
-->

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
				<?= helper('grid.sort', array('column' => 'title')) ?>
			</th>
            <th>
                <?= helper('grid.sort', array('column' => 'islp')) ?>
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
		<? foreach ($streets as $street) : ?>
		<tr>
			<td align="center">
				<?= helper('grid.checkbox', array('row' => $street))?>
			</td>
			<td>
				<a href="<?= route( 'view=street&task=edit&id='. $street->id ); ?>"><?= escape($street->title); ?></a>
			</td>
            <td>
                <?= $street->islp ?>
            </td>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>