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
	<legend><?= @text( 'Details' ); ?></legend>
	<div>
	    <label for="name">
	    	<?= @text( 'Title' ); ?>
	    </label>
	    <div>
	        <input class="required" type="text" name="title" maxlength="255" value="<?= $event->title ?>" placeholder="<?= @text('Title') ?>" />
	    </div>
	</div>
</fieldset>