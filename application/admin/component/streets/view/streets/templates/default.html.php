<?
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
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
                <?= helper('grid.sort', array('column' => 'id', 'title' => 'CRAB')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'islp')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'created_on', 'title' => 'Created on')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'modified_on', 'title' => 'Modified on')) ?>
            </th>
            <th width="1">
                <?= helper('grid.sort', array('column' => 'district_count', 'title' => 'Districts')) ?>
            </th>
            <th width="1">
                <?= helper('grid.sort', array('column' => 'bin_count', 'title' => 'BINs')) ?>
            </th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="8">
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
                <?= $street->id ?>
            </td>
            <td>
                <?= $street->islp ?>
            </td>
            <td>
                <? if($street->created_on) : ?>
                <?= helper('date.format', array('date'=> $street->created_on, 'format' => 'D d/m/Y')) ?>
                <? endif ?>
            </td>
            <td>
                <? if($street->modified_on) : ?>
                <?= helper('date.format', array('date'=> $street->modified_on, 'format' => 'D d/m/Y')) ?>
                <? endif ?>
            </td>
            <td align="center">
                <?= $street->district_count ?>
            </td>
            <td align="center">
                <?= $street->bin_count ?>
            </td>
		</tr>
		<? endforeach; ?>
	</tbody>
	</table>
</form>