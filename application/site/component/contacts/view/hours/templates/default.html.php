<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<? if ($contact->params->get('open_24_7', false)) : ?>
    <h3><?= translate('Opening hours') ?></h3>
    <p>
        <time itemprop="openingHours" datetime="Mo-Su">
            <?= translate('24 hours a day, 7 days a week') ?>
        </time>
    </p>
<? else : ?>

<? if(count($hours)) : ?>
    <table class="table table--striped table--openinghours">
    <caption><?= translate('Opening hours') ?></caption>
    <tbody>
    <? for ($day_of_week = 1; $day_of_week <= 7; $day_of_week++) : ?>
        <? $list = $hours->find(array('day_of_week' => $day_of_week)) ?>
        <tr>
            <td width="25%"><?= helper('date.weekday', array('day_of_week' => $day_of_week)) ?>:</td>
            <td>
            <? if($count = count($list)) : ?>
            <? $i = '1' ?>
            <? foreach ($list as $hour) : ?>
                <? if($hour->appointment) : ?>
                    <?= @translate('Appointment only'); ?>
                <? else : ?>
                    <? $day = helper('date.weekday', array('day_of_week' => $day_of_week, 'translate' => false)) ?>

                    <time itemprop="openingHours" datetime="<?= substr($day, 0, 2).' '.$hour->opening_time.'-'.$hour->closing_time ?>">
                    <?= $hour->opening_time ?>
                    <?= translate('till') ?>
                    <?= $hour->closing_time ?>
                    </time>
                    <?= $i < $count ? translate('and from') : '' ?>
                    <? $i++ ?>
                <?endif ?>
            <? endforeach ?>
            <? if($hour->note) : ?>
                <br /><span class="text--small"><?= $hour->note ?></span>
            <? endif ?>
            <? else : ?>
                <?= translate('Closed') ?>
            <? endif ?>
            </td>
        </tr>
    <? endfor ?>
    </tbody>
</table>
<? endif ?>
<? endif ?>