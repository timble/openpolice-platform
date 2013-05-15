<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<? $information = $event->information ?>

<? $url = @route('view=items&format=json&group='); ?>

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
	    	<?= @text( 'Road' ); ?> 2
	    </label>
	    <div class="controls">
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_road_bis', 'selected' => $event->trafficinfo_item_id_road_bis, 'validate' => false, 'url' => $url.'roads')) ?>
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
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Place' ); ?>
	    </label>
	    <div class="controls">
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_place', 'selected' => $event->trafficinfo_item_id_place, 'validate' => false, 'url' => $url.'places')) ?>
	    </div>
	</div>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Kilometer post' ); ?>
	    </label>
	    <div class="controls">
	        <input type="text" name="information[kilometre_post]" size="5" maxlength="5" value="<?= $information->kilometre_post; ?>" />
	    </div>
	</div>
</fieldset>

<fieldset class="form-horizontal">
	<legend><?= @text( 'Traffic Jam' ); ?></legend>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Length' ); ?> (<?= @text( 'km' ); ?>)
	    </label>
	    <div class="controls">
	        <input type="text" name="information[jam_length]" size="5" maxlength="5" value="<?= $information->jam_length; ?>" />
	    </div>
	</div>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Time' ); ?> (<?= @text( 'min' ); ?>)
	    </label>
	    <div class="controls">
	        <input type="text" name="information[jam_time]" size="5" maxlength="5" value="<?= $information->jam_time; ?>" />
	    </div>
	</div>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Tail Jam' ); ?>
	    </label>
	    <div class="controls">
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_place_end', 'selected' => $event->trafficinfo_item_id_place_end, 'validate' => false, 'url' => $url.'places')) ?>
	    </div>
	</div>
</fieldset>

<fieldset class="form-horizontal">
	<legend><?= @text( 'Details' ); ?>:</legend>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Incident' ); ?>*
	    </label>
	    <div class="controls">
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_incident', 'selected' => $event->trafficinfo_item_id_incident, 'validate' => true, 'url' => $url.'incident')) ?>
	    </div>
	</div>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Traffic type' ); ?>
	    </label>
	    <div class="controls">
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_traffic', 'selected' => $event->trafficinfo_item_id_traffic, 'validate' => false, 'url' => $url.'traffic')) ?>
	    </div>
	</div>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Situation' ); ?>
	    </label>
	    <div class="controls">
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_situation', 'selected' => $event->trafficinfo_item_id_situation, 'validate' => false, 'url' => $url.'situation')) ?>
	    </div>
	</div>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Source' ); ?>
	    </label>
	    <div class="controls">
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_source', 'selected' => $event->trafficinfo_item_id_source, 'validate' => false, 'url' => $url.'source')) ?>
	    </div>
	</div>
</fieldset>