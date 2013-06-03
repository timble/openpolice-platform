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
	<legend><?= @text('Density').' '.$name ?></legend>
	<div>
	    <label for="densities['.$number.'][traffic]">
	    	<?= @text( 'Traffic type' ); ?>
	    </label>
	    <div>
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'densities['.$number.'][traffic]', 'selected' => $density->type, 'validate' => false, 'url' => $url.'traffic')) ?>
	    </div>
	</div>
	<div>
	    <label for="densities['.$number.'][start]">
	    	<?= @text( 'Start' ); ?>
	    </label>
	    <div>
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'densities['.$number.'][start]', 'selected' => $density->start, 'validate' => false, 'url' => $url.'places')) ?>
	    </div>
	</div>
	<div>
	    <label for="densities['.$number.'][end]">
	    	<?= @text( 'End' ); ?>
	    </label>
	    <div>
	        <?= @helper('listbox.items', array('autocomplete' => true, 'name' => 'densities['.$number.'][end]', 'selected' => $density->end, 'validate' => false, 'url' => $url.'places')) ?>
	    </div>
	</div>
</fieldset>