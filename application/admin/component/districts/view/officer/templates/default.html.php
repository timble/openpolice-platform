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
				<fieldset>
					<legend><?= @text( 'Basic Information' ); ?></legend>
					<div>
					    <label for="">
					    	<?= @text( 'Firstname' ); ?>
					    </label>
					    <div>
					        <input class="required" type="text" name="firstname" size="32" maxlength="250" value="<?= $officer->firstname; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= @text( 'Lastname' ); ?>
					    </label>
					    <div>
					        <input class="required" type="text" name="lastname" size="32" maxlength="250" value="<?= $officer->lastname; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= @text( 'Position' ); ?>
					    </label>
					    <div>
					        <input type="text" name="position" size="32" maxlength="250" value="<?= $officer->position; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= @text( 'Number' ); ?>
					    </label>
					    <div>
					        <input type="text" name="number" size="32" maxlength="250" value="<?= $officer->number; ?>" />
					    </div>
					</div>
				</fieldset>
				<fieldset>
					<legend><?= @text( 'Contact information' ); ?></legend>
					<div>
					    <label for="">
					    	<?= @text( 'Phone' ); ?>
					    </label>
					    <div>
					        <input type="text" name="phone" size="32" maxlength="250" value="<?= $officer->phone; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= @text( 'Mobile' ); ?>
					    </label>
					    <div>
					        <input type="text" name="mobile" size="32" maxlength="250" value="<?= $officer->mobile; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= @text( 'E-mail' ); ?>
					    </label>
					    <div>
					        <input type="text" name="email" size="32" maxlength="250" value="<?= $officer->email; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= @text( 'Twitter' ); ?>
					    </label>
					    <div>
					        <input type="text" name="params[twitter]" size="32" maxlength="250" value="<?= $params->twitter; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= @text( 'Facebook' ); ?>
					    </label>
					    <div>
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
				<fieldset>
					<legend><?= @text( 'Extra information' ); ?></legend>
					<div>
					    <label for="">
					    	<?= @text( 'Image' ); ?>
					    </label>
					    <div>
					        <?= @helper('image.listbox', array('name' => 'params[avatar]', 'directory' => JPATH_IMAGES.'/avatars', 'selected' => $params->avatar)); ?>
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= @text( 'Show image' ); ?>
					    </label>
					    <div>
					        <input type="checkbox" name="params[show_avatar]" value="1" <?= $params->show_avatar ? 'checked="checked"' : '' ?> />
					    </div>
					</div>
					
				</fieldset>
			</div>
		</div>
	</div>
</form>