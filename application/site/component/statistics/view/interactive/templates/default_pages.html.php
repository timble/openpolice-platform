<?php
/**
 * Belgian Police Web Platform - Statistics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
 ?>

<?
    $graphs = array(
        'Overview' => array(
            'By criminal figure' => 'pcs_dashboard_crimfig_misdrijven',
            'By police zone' => 'pcs_dashboard_pz_crimfig_misdrijven'
        ),
        'Table' => array(
            'By main categories' => 'pcs_table_inbreuk_per_plaats',
            'By criminal figure' => 'pcs_table_crimfig_per_plaats',
            'By police zone' => 'pcs_table_crimfig_per_pz'
        ),
        'Map' => array(
            'Car theft' => 'pcs_mapchoropleth_crimfig_autodiefstal',
            'Theft from vehicle' => 'pcs_mapchoropleth_crimfig_diefstaluitofaanvoertuig',
            'Housebreaking' => 'pcs_mapchoropleth_crimfig_woninginbraakstrikt',
            'Intrafamily voilence' => 'pcs_mapchoropleth_crimfig_ifgalgemeentotaal'
        ),
        'Graph' => array(
            'Histogram main categories' => 'pcs_barchartvtime_inbreuk_tijd_inbreuken',
            'Timeline criminal figure' => 'pcs_timeline_crimfig_tijd_crimfiguren'
        )
    );
?>

<? foreach($graphs as $key => $value) : ?>
<div class="one-fourth">
    <h3><?= translate($key) ?></h3>
    <ul class="nav nav--pills">
    <? foreach($value as $key => $value) : ?>
        <li<?= isset($graph) && $graph == $value ? ' class="active"' : '' ?>>
            <a href="?view=interactive&graph=<?= $value ?>"><?= translate($key) ?></a>
        </li>
    <? endforeach ?>
    </ul>
</div>
<? endforeach ?>
