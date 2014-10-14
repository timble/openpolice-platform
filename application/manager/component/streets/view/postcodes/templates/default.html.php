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

<form action="" method="get" class="-koowa-grid">
    <?= import('default_scopebar.html'); ?>
    <table>
        <thead>
        <tr>
            <th>
                <?= helper('grid.sort', array('column' => 'title')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'id', 'title' => 'Postcode')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'streets_city_id', 'title' => 'NIS')) ?>
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
        <? foreach ($postcodes as $postcode) : ?>
            <tr>
                <td>
                    <a href="<?= route( 'view=postcode&task=edit&id='. $postcode->id ); ?>"><?= escape($postcode->title); ?></a>
                </td>
                <td>
                    <?= $postcode->id ?>
                </td>
                <td>
                    <?= $postcode->streets_city_id ?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</form>