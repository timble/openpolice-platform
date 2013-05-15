<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<fieldset class="form-horizontal">
	<legend><?= @text( 'Location' ); ?></legend>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Road' ); ?>*
	    </label>
	    <div class="controls">
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_road', 'selected' => $event->trafficinfo_item_id_road, 'validate' => true, 'url' => $url.'roads')) ?>
	    </div>
	</div>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Direction' ); ?>
	    </label>
	    <div class="controls">
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_place_direction', 'selected' => $event->trafficinfo_item_id_place_direction, 'validate' => false, 'url' => $url.'places')) ?>
	    </div>
	</div>
</fieldset>
<fieldset class="form-horizontal">
	<legend><?= @text( 'Details' ); ?>:</legend>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Source' ); ?>
	    </label>
	    <div class="controls">
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_source', 'selected' => $event->trafficinfo_item_id_source, 'validate' => false, 'url' => $url.'source')) ?>
	    </div>
	</div>
</fieldset>

<? $densities = $event->densities ?>
<?= @template('form_density_repeater', array('name' => '1', 'number' => 'one', 'density' => $densities->one)); ?>
<?= @template('form_density_repeater', array('name' => '2', 'number' => 'two', 'density' => $densities->two)); ?>
<?= @template('form_density_repeater', array('name' => '3', 'number' => 'three', 'density' => $densities->three)); ?>
<?= @template('form_density_repeater', array('name' => '4', 'number' => 'four', 'density' => $densities->four)); ?>
