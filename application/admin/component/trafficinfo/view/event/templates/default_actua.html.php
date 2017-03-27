<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<fieldset>
	<legend><?= translate( 'Details' ); ?></legend>
	<div>
	    <label for="name">
	    	<?= translate( 'Title' ); ?>
	    </label>
	    <div>
	        <input class="required" type="text" name="title" maxlength="255" value="<?= $event->title ?>" placeholder="<?= translate('Title') ?>" />
	    </div>
	</div>
</fieldset>