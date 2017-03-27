<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<fieldset>
	<legend><?= translate( 'Location' ); ?></legend>
	<div>
	    <label for="name">
	    	<?= translate( 'Road' ); ?>*
	    </label>
	    <div>
	        <?= helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_road', 'selected' => $event->trafficinfo_item_id_road, 'validate' => true, 'url' => $url.'roads')) ?>
	    </div>
	</div>
	<div>
	    <label for="name">
	    	<?= translate( 'Direction' ); ?>
	    </label>
	    <div>
	        <?= helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_place_direction', 'selected' => $event->trafficinfo_item_id_place_direction, 'validate' => false, 'url' => $url.'places')) ?>
	    </div>
	</div>
</fieldset>
<fieldset>
	<legend><?= translate( 'Details' ); ?>:</legend>
	<div>
	    <label for="name">
	    	<?= translate( 'Source' ); ?>
	    </label>
	    <div>
	        <?= helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_source', 'selected' => $event->trafficinfo_item_id_source, 'validate' => false, 'url' => $url.'source')) ?>
	    </div>
	</div>
</fieldset>

<? $densities = $event->densities ?>
<?= import('form_density_repeater', array('name' => '1', 'number' => 'one', 'density' => $densities->one)); ?>
<?= import('form_density_repeater', array('name' => '2', 'number' => 'two', 'density' => $densities->two)); ?>
<?= import('form_density_repeater', array('name' => '3', 'number' => 'three', 'density' => $densities->three)); ?>
<?= import('form_density_repeater', array('name' => '4', 'number' => 'four', 'density' => $densities->four)); ?>
