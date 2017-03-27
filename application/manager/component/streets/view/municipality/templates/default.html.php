<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
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
		    <input class="required" type="text" name="title" maxlength="255" value="<?= $municipality->title ?>" placeholder="<?= translate('Title') ?>" />
		</div>
	
		<div class="scrollable">
			<fieldset>
				<legend><?= translate( 'Information' ); ?>:</legend>
				<div>
				    <label for="postcode">
				    	<?= translate( 'Postcode' ); ?>
				    </label>
				    <div>
				        <input class="required" type="text" name="postcode" maxlength="4" value="<?= $municipality->postcode; ?>" />
				    </div>
				</div>
                <div>
				    <label for="name">
				    	<?= translate( 'Zone' ); ?>
				    </label>
				    <div>
				        <?= helper('listbox.zones', array('deselect' => false, 'attribs' => array('class' => 'chzn-select'))) ?>
				    </div>
				</div>
                <div>
				    <label for="postcode">
				    	<?= translate( 'City' ); ?>
				    </label>
				    <div>
				        <?= helper('com:police.listbox.cities',
							array(
								'autocomplete' => true,
								'name'		   => 'parent_id',
								'validate'     => false,
                                'filter'       => array('parent_id' => '0')
							)) ?>
				    </div>
				</div>
			</fieldset>
		</div>
	</div>
</form>