<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<fieldset>
	<legend><?= @text( 'Location' ); ?></legend>
	<div>
	    <label for="name">
	    	<?= @text( 'Road' ); ?>*
	    </label>
	    <div>
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_road', 'selected' => $event->trafficinfo_item_id_road, 'validate' => true, 'url' => $url.'roads')) ?>
	    </div>
	</div>
	<div>
	    <label for="name">
	    	<?= @text( 'Direction' ); ?>
	    </label>
	    <div>
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_place_direction', 'selected' => $event->trafficinfo_item_id_place_direction, 'validate' => false, 'url' => $url.'places')) ?>
	    </div>
	</div>
	<div>
	    <label for="name">
	    	<?= @text( 'Place' ); ?>
	    </label>
	    <div>
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_place', 'selected' => $event->trafficinfo_item_id_place, 'validate' => false, 'url' => $url.'places')) ?>
	    </div>
	</div>
	<div>
	    <label for="name">
	    	<?= @text( 'Kilometer post' ); ?>
	    </label>
	    <div>
	        <input type="text" name="information[kilometre_post]" size="5" maxlength="5" value="<?= $event->kilometre_post; ?>" />
	    </div>
	</div>
</fieldset>
<fieldset>
	<legend><?= @text( 'Details' ); ?>:</legend>
	<div>
	    <label for="name">
	    	<?= @text( 'Source' ); ?>
	    </label>
	    <div>
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'trafficinfo_item_id_source', 'selected' => $event->trafficinfo_item_id_source, 'validate' => false, 'filter' => array('group' => 'source'))) ?>
	    </div>
	</div>
</fieldset>
