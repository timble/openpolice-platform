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
	<legend><?= @text( 'Details' ); ?>:</legend>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Situation' ); ?>
	    </label>
	    <div class="controls">
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_situation', 'selected' => $event->trafficinfo_item_id_situation, 'validate' => false, 'url' => $url.'situation')) ?>
	    </div>
	</div>
</fieldset>