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
	<legend><?= @text( 'Details' ); ?></legend>
	<div class="control-group">
	    <label class="control-label" for="name">
	    	<?= @text( 'Title' ); ?>
	    </label>
	    <div class="controls">
	        <input class="required" type="text" name="title" maxlength="255" value="<?= $event->title ?>" placeholder="<?= @text('Title') ?>" />
	    </div>
	</div>
</fieldset>