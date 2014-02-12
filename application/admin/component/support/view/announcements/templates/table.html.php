<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<table class="table">
    <? foreach($announcements as $announcement) : ?>
    <tr>
        <td>
            <a href="<?= route( 'view=announcement&id='.$announcement->id ); ?>">
                <?= escape($announcement->title) ?>
            </a>
        </td>
        <td>
            <?= helper('date.humanize', array('date' => $announcement->created_on)) ?>
        </td>
    </tr>
    <? endforeach ?>
</table>