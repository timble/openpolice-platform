<?
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<?= helper('behavior.validator'); ?>

<!--
<script src="assets://js/koowa.js" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" class="-koowa-form">
	<div class="main">
		<div class="title">
		    <input class="required" type="text" name="title" maxlength="255" value="<?= $street->title ?>" placeholder="<?= translate('Title') ?>" />
		</div>
	
		<div class="scrollable">
			<fieldset>
				<legend><?= translate( 'Information' ); ?>:</legend>
				<div>
				    <label for="name">
				    	<?= translate( 'Municipality' ); ?>
				    </label>
				    <div>
				        <?= helper('com:police.listbox.municipalities', array('deselect' => false, 'filter' => array('zone' => '5388'))) ?>
				    </div>
				</div>
			</fieldset>
		</div>
	</div>
</form>