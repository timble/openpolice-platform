<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<div id="jams-jams-default">
	<? foreach ($events as $event) : ?>
	<div class="jam category-<?= $event->trafficinfo_category_id ?>">
			
		<div class="header clearfix">
			<div class="header-left">
				<?= helper('date.format', array('date' => $event->last_activity_on, 'format' => 'H:i')) ?><br />
				<?= helper('date.format', array('date' => $event->last_activity_on, 'format' => 'd/m')) ?>
			</div>
			
			<div class="header-right">
				<div>	
					<h3><?= helper('com:trafficinfo.string.title', array('row' => $event)); ?></h3>
					<?= helper('com:trafficinfo.string.location', array('row' => $event)); ?><br />
					<?= helper('com:trafficinfo.string.info', array('row' => $event)); ?>
				</div>
				<? $details = helper('com:trafficinfo.string.details', array('row' => $event)); ?>
				<? if($details OR $event->post) : ?>
					<div class="details">
						<?= $details ?>
						<? if($event->post) : ?>
						<span class="details-post"><?= translate('Kilometer post') ?>: <?= $event->post ?></span>
						<? endif; ?>
					</div>
				<? endif; ?>
			</div>
			
		</div>
		
		<div class="body">
			<?= $event->text ?>
		</div>
		
		<? if($event->jams_category_id == '5') : ?>
		   <?= import('default_density', array('jam' => $event)); ?>
		<? endif; ?>
		
		<div class="footer">
			<small><strong><?= translate('Latest update') ?></strong>: <?= helper('date.humanize', array('date' => $event->last_activity_on)) ?><? if($event->source) : ?><span style="float: right;"><strong><?= translate('Source') ?></strong>: <em><?= $event->source ?></em><? endif; ?></span></small>
		</div>
	</div>
	<? endforeach; ?>
</div>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>