<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<div>
<?= helper('com:trafficinfo.template.helper.string.location', array('row' => $event)); ?> <? if($event->post) : ?>(<?= translate('Kilometer post') ?>: <?= $event->post ?>)<? endif ?>
</div>

<div>
<?= helper('com:trafficinfo.template.helper.string.info', array('row' => $event)); ?>
</div>

<div>
<?= helper('com:trafficinfo.template.helper.string.details', array('row' => $event)); ?>
</div>

<? if($event->description) : ?><p><?= $event->description ?></p><? endif; ?>