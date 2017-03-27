<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright    Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license        GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/timble/openpolice-platform
 */
?>

<? $days = array('1' => 'Mo', '2' => 'Tu', '3' => 'We', '4' => 'Th', '5' => 'Fr', '6' => 'Sa', '7' => 'Su'); ?>

<? if ($contact->params->get('open_24_7', false)) : ?>
    ,"openingHours": "Mo-Su"
<? else : ?>

    <? if (count($hours)) : ?>
        <? $weekly = $hours->find(array('date' => '')) ?>
        <? $exceptions = $hours->find(array('date' => true)) ?>

        <? if (count($weekly)) : ?>
            <? $i = '1' ?>
            ,"openingHours": [
            <? foreach ($weekly as $hour) : ?>
                "<?= $days[$hour->day_of_week] . ' ' . $hour->opening_time . '-' . $hour->closing_time ?>"<?= $i != count($weekly) ? ',' : '' ?>
                <? $i++ ?>
            <? endforeach ?>
            ]
        <? endif ?>
        <? if (count($exceptions)) : ?>
            <? $i = '1' ?>
            ,"openingHoursSpecification": [
            <? foreach ($exceptions as $hour) : ?>
                {
                "@type": "OpeningHoursSpecification",
                "validFrom": "<?= $hour->date ?>",
                "validThrough": "<?= $hour->date ?>",
                "opens": "<?= $hour->opening_time ? $hour->opening_time : '00:00' ?>",
                "closes": "<?= $hour->closing_time ? $hour->closing_time : '00:00' ?>"
                }<?= $i != count($exceptions) ? ',' : '' ?>
                <? $i++ ?>
            <? endforeach ?>
            ]
        <? endif ?>
    <? endif ?>
<? endif ?>