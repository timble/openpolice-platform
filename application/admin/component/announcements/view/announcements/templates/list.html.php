<?
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<table class="table">
    <? foreach($announcements as $announcement): ?>
        <tr>
            <td>
                <a target="_blank" href="<?= $announcement->url ?>">
                    <?= $announcement->title ?>
                </a>
            </td>
            <td>
                <?= helper('date.humanize', array('date' => $announcement->date)) ?>
            </td>
        </tr>
    <? endforeach ?>
</table>
