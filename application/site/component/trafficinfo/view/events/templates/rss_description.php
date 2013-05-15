<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<div>
<?= @helper('com:trafficinfo.template.helper.string.location', array('row' => $event)); ?> <? if($event->post) : ?>(<?= @text('Kilometer post') ?>: <?= $event->post ?>)<? endif ?>
</div>

<div>
<?= @helper('com:trafficinfo.template.helper.string.info', array('row' => $event)); ?>
</div>

<div>
<?= @helper('com:trafficinfo.template.helper.string.details', array('row' => $event)); ?>
</div>

<? if($event->description) : ?><p><?= $event->description ?></p><? endif; ?>