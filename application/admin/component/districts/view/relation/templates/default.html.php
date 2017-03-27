<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
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
		<div class="scrollable">
			<fieldset>
				<legend><?= translate( 'Relation' ); ?></legend>
				<div style="height: 50px">
				    <label for="districts_district_id">
				    	<?= translate( 'District' ); ?>
				    </label>
				    <div>
				        <?= helper('listbox.districts', array('selected' => $relation->districts_district_id, 'deselect' => false, 'attribs' => array('class' => 'select-district required', 'style' => 'width:100%'))) ?>
                        <script data-inline> $jQuery(".select-district").select2(); </script>
				    </div>
				</div>
				<div>
				    <label for="streets_street_id">
				    	<?= translate( 'Street' ); ?>
				    </label>
					<div>
						<?= import('com:streets.view.streets.autocomplete.html', array('selected' => isset($street) ? $street->id : '', 'identifier' => isset($street) ? $street->streets_street_identifier : '')); ?>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend><?= translate( 'Exceptions' ); ?></legend>
				<div>
				    <label for="range_start">
				    	<?= translate( 'Start' ); ?>
				    </label>
				    <div>
				        <input type="text" name="range_start" maxlength="250" class="required validate-integer" value="<?= $relation->range_start; ?>" />
				    </div>
				</div>
				<div>
				    <label for="range_end">
				    	<?= translate( 'End' ); ?>
				    </label>
				    <div>
				        <input type="text" name="range_end" maxlength="250" class="required validate-integer" value="<?= $relation->range_end == null ? '9999' : $relation->range_end; ?>" />
				    </div>
				</div>
				<div>
				    <label for="range_parity">
				    	<?= translate( 'Parity' ); ?>
				    </label>
				    <div>
				        <?= helper('listbox.parities', array('selected' => $relation->range_parity)) ?>
				    </div>
				</div>
			</fieldset>
		</div>
	</div>
</form>