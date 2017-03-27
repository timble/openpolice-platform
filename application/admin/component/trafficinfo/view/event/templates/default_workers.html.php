<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? $information = $event->information ?>

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
	<legend><?= translate( 'Details' ); ?>:</legend>
	<div>
	    <label for="name">
	    	<?= translate( 'Situation' ); ?>
	    </label>
	    <div>
	        <?= helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_situation', 'selected' => $event->trafficinfo_item_id_situation, 'validate' => false, 'url' => $url.'situation')) ?>
	    </div>
	</div>
</fieldset>