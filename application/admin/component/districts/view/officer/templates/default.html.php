<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<?= @helper('behavior.validator'); ?>

<!--
<script src="media://js/koowa.js" />
-->

<ktml:module position="toolbar">
    <?= @helper('toolbar.render', array('toolbar' => $toolbar))?>
</ktml:module>

<form action="" method="post" class="-koowa-form">
	<input type="hidden" name="params[show_avatar]" value="0" />
	<div class="main">
		<div class="scrollable row-fluid">
			<div class="span8">
				<fieldset class="form-horizontal">
					<legend><?= @text( 'Basic Information' ); ?></legend>
					<div class="control-group">
					    <label class="control-label" for="">
					    	<?= @text( 'Firstname' ); ?>
					    </label>
					    <div class="controls">
					        <input class="required" type="text" name="firstname" size="32" maxlength="250" value="<?= $officer->firstname; ?>" />
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="">
					    	<?= @text( 'Lastname' ); ?>
					    </label>
					    <div class="controls">
					        <input class="required" type="text" name="lastname" size="32" maxlength="250" value="<?= $officer->lastname; ?>" />
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="">
					    	<?= @text( 'Position' ); ?>
					    </label>
					    <div class="controls">
					        <input type="text" name="position" size="32" maxlength="250" value="<?= $officer->position; ?>" />
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="">
					    	<?= @text( 'Number' ); ?>
					    </label>
					    <div class="controls">
					        <input type="text" name="number" size="32" maxlength="250" value="<?= $officer->number; ?>" />
					    </div>
					</div>
				</fieldset>
				<fieldset class="form-horizontal">
					<legend><?= @text( 'Contact information' ); ?></legend>
					<div class="control-group">
					    <label class="control-label" for="">
					    	<?= @text( 'Phone' ); ?>
					    </label>
					    <div class="controls">
					        <input type="text" name="phone" size="32" maxlength="250" value="<?= $officer->phone; ?>" />
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="">
					    	<?= @text( 'Mobile' ); ?>
					    </label>
					    <div class="controls">
					        <input type="text" name="mobile" size="32" maxlength="250" value="<?= $officer->mobile; ?>" />
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="">
					    	<?= @text( 'E-mail' ); ?>
					    </label>
					    <div class="controls">
					        <input type="text" name="email" size="32" maxlength="250" value="<?= $officer->email; ?>" />
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="">
					    	<?= @text( 'Twitter' ); ?>
					    </label>
					    <div class="controls">
					        <input type="text" name="params[twitter]" size="32" maxlength="250" value="<?= $params->twitter; ?>" />
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="">
					    	<?= @text( 'Facebook' ); ?>
					    </label>
					    <div class="controls">
					        <input type="text" name="params[facebook]" size="32" maxlength="250" value="<?= $params->facebook; ?>" />
					    </div>
					</div>
				</fieldset>
				<fieldset>
					<legend><?= @text( 'Districts' ); ?></legend>
					<ul>
					<? $districts = $this->getObject('com:districts.model.districts_officers')->officer($officer->id)->getRowset() ?>
					<? foreach ($this->getObject('com:districts.model.districts_officers')->officer($officer->id)->getRowset() as $value) : ?>
						<li><?= @escape($value->district); ?></li>
					<? endforeach; ?>
					<? if(!count($districts)) : ?>
						<li><?= @text('No district') ?></li>
					<? endif ?>
					</ul>
				</fieldset>
			</div>
			<div class="span4">
				<fieldset class="form-horizontal">
					<legend><?= @text( 'Extra information' ); ?></legend>
					<div class="control-group">
					    <label class="control-label" for="">
					    	<?= @text( 'Image' ); ?>
					    </label>
					    <div class="controls">
					        <?= @helper('image.listbox', array('name' => 'params[avatar]', 'directory' => JPATH_IMAGES.'/avatars', 'selected' => $params->avatar)); ?>
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="">
					    	<?= @text( 'Show image' ); ?>
					    </label>
					    <div class="controls">
					        <input type="checkbox" name="params[show_avatar]" value="1" <?= $params->show_avatar ? 'checked="checked"' : '' ?> />
					    </div>
					</div>
					
				</fieldset>
			</div>
		</div>
	</div>
</form>