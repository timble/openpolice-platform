<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<!--
<script src="assets://js/koowa.js" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" class="-koowa-form">
	<div class="main">
		<div class="title">
		    <input class="required" type="text" name="title" maxlength="255" value="<?= $zone->title ?>" placeholder="<?= translate('Title') ?>" />
		</div>
	
		<div class="scrollable">
			<fieldset>
				<legend><?= translate( 'Information' ); ?>:</legend>
				<div>
				    <label for="id">
				    	<?= translate( 'ID' ); ?>
				    </label>
				    <div>
				        <input class="required" type="text" name="id" maxlength="4" value="<?= $zone->id; ?>" />
				    </div>
				</div>
                <div>
				    <label for="name">
				    	<?= translate( 'Language' ); ?>
				    </label>
				    <div>
				        <?= helper('listbox.language', array('deselect' => false)) ?>
				    </div>
				</div>
			</fieldset>
		</div>
	</div>
</form>