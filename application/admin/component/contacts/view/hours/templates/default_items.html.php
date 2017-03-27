<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<tr>
    <td align="center">
        <?= helper('grid.checkbox', array('row' => $hour))?>
    </td>
    <td align="center">
        <?= helper('grid.enable', array('row' => $hour, 'field' => 'published')) ?>
    </td>
    <td>
        <a href="<?= @route( 'view=hour&id='.$hour->id.'&contact='.$hour->contacts_contact_id ); ?>">
            <? if($hour->date) : ?>
            <?= date(array('date' => $hour->date, 'format' => 'l d M Y')) ?>
            <? else : ?>
            <?= helper('date.weekday', array('day_of_week' => $hour->day_of_week)) ?>
            <? endif ?>
        </a>
    </td>
    <? if($hour->opening_time && $hour->closing_time) : ?>
        <td>
            <?= $hour->opening_time ?>
        </td>
        <td>
            <?= $hour->closing_time ?>
        </td>
    <? else : ?>
        <td colspan="2">
            <?= $hour->appointment ? translate('Appointment only') : translate('Closed') ?>
        </td>
    <? endif ?>
</tr>
