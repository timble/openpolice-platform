<?
/**
 * Belgian Police Web Platform - Uploads Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="get" class="-koowa-grid">
    <table>
        <thead>
        <tr>
            <th width="10">
                <?= helper( 'grid.checkall'); ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'table')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'created_on')) ?>
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
        <? foreach ($uploads as $upload) : ?>
            <tr>
                <td align="center">
                    <?= helper('grid.checkbox', array('row' => $upload))?>
                </td>
                <td>
                    <?= $upload->table ?>
                </td>
                <td>
                    <?= escape($upload->created_on); ?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</form>