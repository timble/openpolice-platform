<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? $information = $event->information ?>

<? $url = route('view=items&format=json&group='); ?>

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
	    	<?= translate( 'Road' ); ?> 2
	    </label>
	    <div>
	        <?= helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_road_bis', 'selected' => $event->trafficinfo_item_id_road_bis, 'validate' => false, 'url' => $url.'roads')) ?>
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
	<div>
	    <label for="name">
	    	<?= translate( 'Place' ); ?>
	    </label>
	    <div>
	        <?= helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_place', 'selected' => $event->trafficinfo_item_id_place, 'validate' => false, 'url' => $url.'places')) ?>
	    </div>
	</div>
	<div>
	    <label for="name">
	    	<?= translate( 'Kilometer post' ); ?>
	    </label>
	    <div>
	        <input type="text" name="information[kilometre_post]" size="5" maxlength="5" value="<?= $information->kilometre_post; ?>" />
	    </div>
	</div>
</fieldset>

<fieldset>
	<legend><?= translate( 'Traffic Jam' ); ?></legend>
	<div>
	    <label for="name">
	    	<?= translate( 'Length' ); ?> (<?= translate( 'km' ); ?>)
	    </label>
	    <div>
	        <input type="text" name="information[jam_length]" size="5" maxlength="5" value="<?= $information->jam_length; ?>" />
	    </div>
	</div>
	<div>
	    <label for="name">
	    	<?= translate( 'Time' ); ?> (<?= translate( 'min' ); ?>)
	    </label>
	    <div>
	        <input type="text" name="information[jam_time]" size="5" maxlength="5" value="<?= $information->jam_time; ?>" />
	    </div>
	</div>
	<div>
	    <label for="name">
	    	<?= translate( 'Tail Jam' ); ?>
	    </label>
	    <div>
	        <?= helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_place_end', 'selected' => $event->trafficinfo_item_id_place_end, 'validate' => false, 'url' => $url.'places')) ?>
	    </div>
	</div>
</fieldset>

<fieldset>
	<legend><?= translate( 'Details' ); ?>:</legend>
	<div>
	    <label for="name">
	    	<?= translate( 'Incident' ); ?>*
	    </label>
	    <div>
	        <?= helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_incident', 'selected' => $event->trafficinfo_item_id_incident, 'validate' => true, 'url' => $url.'incident')) ?>
	    </div>
	</div>
	<div>
	    <label for="name">
	    	<?= translate( 'Traffic type' ); ?>
	    </label>
	    <div>
	        <?= helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_traffic', 'selected' => $event->trafficinfo_item_id_traffic, 'validate' => false, 'url' => $url.'traffic')) ?>
	    </div>
	</div>
	<div>
	    <label for="name">
	    	<?= translate( 'Situation' ); ?>
	    </label>
	    <div>
	        <?= helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_situation', 'selected' => $event->trafficinfo_item_id_situation, 'validate' => false, 'url' => $url.'situation')) ?>
	    </div>
	</div>
	<div>
	    <label for="name">
	    	<?= translate( 'Source' ); ?>
	    </label>
	    <div>
	        <?= helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_source', 'selected' => $event->trafficinfo_item_id_source, 'validate' => false, 'url' => $url.'source')) ?>
	    </div>
	</div>
</fieldset>