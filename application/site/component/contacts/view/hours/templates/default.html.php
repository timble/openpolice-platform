<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<? if(count($hours)) : ?>
<table class="table table--striped table--responsive">
<? for ($day_of_week = 1; $day_of_week <= 7; $day_of_week++) : ?>
	<? $list = $hours->find(array('day_of_week' => $day_of_week)) ?>
	<tr>
		<td><?= helper('date.weekday', array('day_of_week' => $day_of_week)) ?></td>
		<td>
		<? if($count = count($list)) : ?>
		<? foreach ($list as $key => $hour) : ?>
            <?= helper('date.format', array('date'=> $hour->opening_time, 'format' => 'H:i')) ?>
            <?= translate('till') ?>
            <?= helper('date.format', array('date'=> $hour->closing_time, 'format' => 'H:i')) ?>
			<?= $key < $count ? translate('and from') : '' ?>
		<? endforeach ?>
		<? else : ?>
			<?= translate('Closed') ?>
		<? endif ?>
		</td>
	</tr>
<? endfor ?>
</table>
<? endif ?>