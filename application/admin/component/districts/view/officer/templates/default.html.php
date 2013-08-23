<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<?= helper('behavior.validator'); ?>

<!--
<script src="media://js/koowa.js" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" class="-koowa-form">
	<input type="hidden" name="params[show_avatar]" value="0" />
	<div class="main">
		<div class="scrollable row-fluid">
			<div class="span8">
				<fieldset>
					<legend><?= translate( 'Basic Information' ); ?></legend>
					<div>
					    <label for="">
					    	<?= translate( 'Firstname' ); ?>
					    </label>
					    <div>
					        <input class="required" type="text" name="firstname" size="32" maxlength="250" value="<?= $officer->firstname; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= translate( 'Lastname' ); ?>
					    </label>
					    <div>
					        <input class="required" type="text" name="lastname" size="32" maxlength="250" value="<?= $officer->lastname; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= translate( 'Position' ); ?>
					    </label>
					    <div>
					        <input type="text" name="position" size="32" maxlength="250" value="<?= $officer->position; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= translate( 'Number' ); ?>
					    </label>
					    <div>
					        <input type="text" name="number" size="32" maxlength="250" value="<?= $officer->number; ?>" />
					    </div>
					</div>
				</fieldset>
				<fieldset>
					<legend><?= translate( 'Contact information' ); ?></legend>
					<div>
					    <label for="">
					    	<?= translate( 'Phone' ); ?>
					    </label>
					    <div>
					        <input type="text" name="phone" size="32" maxlength="250" value="<?= $officer->phone; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= translate( 'Mobile' ); ?>
					    </label>
					    <div>
					        <input type="text" name="mobile" size="32" maxlength="250" value="<?= $officer->mobile; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= translate( 'E-mail' ); ?>
					    </label>
					    <div>
					        <input type="text" name="email" size="32" maxlength="250" value="<?= $officer->email; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= translate( 'Twitter' ); ?>
					    </label>
					    <div>
					        <input type="text" name="params[twitter]" size="32" maxlength="250" value="<?= $params->twitter; ?>" />
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= translate( 'Facebook' ); ?>
					    </label>
					    <div>
					        <input type="text" name="params[facebook]" size="32" maxlength="250" value="<?= $params->facebook; ?>" />
					    </div>
					</div>
				</fieldset>
				<fieldset>
					<legend><?= translate( 'Districts' ); ?></legend>
					<ul>
					<? $districts = $this->getObject('com:districts.model.districts_officers')->officer($officer->id)->getRowset() ?>
					<? foreach ($this->getObject('com:districts.model.districts_officers')->officer($officer->id)->getRowset() as $value) : ?>
						<li><?= escape($value->district); ?></li>
					<? endforeach; ?>
					<? if(!count($districts)) : ?>
						<li><?= translate('No district') ?></li>
					<? endif ?>
					</ul>
				</fieldset>
			</div>
			<div class="span4">
				<fieldset>
					<legend><?= translate( 'Extra information' ); ?></legend>
					<div>
					    <label for="">
					    	<?= translate( 'Image' ); ?>
					    </label>
					    <div>
					        <?= helper('image.listbox', array('name' => 'params[avatar]', 'directory' => JPATH_IMAGES.'/avatars', 'selected' => $params->avatar)); ?>
					    </div>
					</div>
					<div>
					    <label for="">
					    	<?= translate( 'Show image' ); ?>
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