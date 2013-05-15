<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<!--
<script src="media://js/koowa.js" />
-->

<ktml:module position="toolbar">
    <?= @helper('toolbar.render', array('toolbar' => $toolbar))?>
</ktml:module>

<form action="" method="post" class="-koowa-form">
	<div class="main">
		<div class="title">
		    <input class="required" type="text" name="title" maxlength="255" value="<?= $zone->title ?>" placeholder="<?= @text('Title') ?>" />
		</div>
	
		<div class="scrollable">
			<fieldset class="form-horizontal">
				<legend><?= @text( 'Information' ); ?>:</legend>
				<div class="control-group">
				    <label class="control-label" for="id">
				    	<?= @text( 'ID' ); ?>
				    </label>
				    <div class="controls">
				        <input class="required" type="text" name="id" maxlength="4" value="<?= $zone->id; ?>" />
				    </div>
				</div>
                <div class="control-group">
				    <label class="control-label" for="name">
				    	<?= @text( 'Language' ); ?>
				    </label>
				    <div class="controls">
				        <?= @helper('listbox.language', array('deselect' => false)) ?>
				    </div>
				</div>
                <div class="control-group">
				    <label class="control-label" for="chief_name">
				    	<?= @text( 'Chief name' ); ?>
				    </label>
				    <div class="controls">
				        <input class="required" type="text" name="chief_name" value="<?= $zone->chief_name; ?>" />
				    </div>
				</div>
                <div class="control-group">
				    <label class="control-label" for="chief_email">
				    	<?= @text( 'Chief email' ); ?>
				    </label>
				    <div class="controls">
				        <input class="required" type="text" name="chief_email" value="<?= $zone->chief_email; ?>" />
				    </div>
				</div>
			</fieldset>
		</div>
	</div>
</form>