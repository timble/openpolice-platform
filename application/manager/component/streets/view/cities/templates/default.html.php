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
                <?= helper('grid.sort', array('column' => 'title')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'id', 'title' => 'NIS')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'language')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'police_zone_id', 'title' => 'Zone ID')) ?>
            </th>
            <th>
                <?= helper('grid.sort', array('column' => 'crab_city_id', 'title' => 'CRAB')) ?>
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
        <? foreach ($cities as $city) : ?>
            <tr>
                <td>
                    <a href="<?= route( 'view=city&task=edit&id='. $city->id ); ?>"><?= escape($city->title); ?></a>
                </td>
                <td>
                    <?= $city->id ?>
                </td>
                <td>
                    <?= $city->language ?>
                </td>
                <td>
                    <?= $city->police_zone_id ?>
                </td>
                <td>
                    <?= $city->crab_city_id ?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</form>