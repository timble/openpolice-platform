<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
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
		<div class="scrollable">
			<fieldset>
				<legend><?= translate( 'Relation' ); ?></legend>
				<div>
				    <label for="">
				    	<?= translate( 'District' ); ?>
				    </label>
				    <div>
				        <?= helper('listbox.districts', array('selected' => $relation->districts_district_id, 'deselect' => false, 'attribs' => array('class' => 'select-district', 'style' => 'width:100%'))) ?>
                        <script data-inline> $jQuery(".select-district").select2(); </script>
				    </div>
				</div>
				<div>
				    <label for="">
				    	<?= translate( 'Street' ); ?>
				    </label>
				    <div>
				        <?= helper('com:streets.listbox.streets', array('autocomplete' => true, 'name' => 'streets_street_id', 'selected' => $relation->districts_street_id, 'validate' => true)) ?>
				    </div>
				</div>
			</fieldset>
			<fieldset>
				<legend><?= translate( 'Exceptions' ); ?></legend>
				<div>
				    <label for="">
				    	<?= translate( 'Start' ); ?>
				    </label>
				    <div>
				        <input type="text" name="range_start" size="32" maxlength="250" value="<?= $relation->range_start; ?>" />
				    </div>
				</div>
				<div>
				    <label for="">
				    	<?= translate( 'End' ); ?>
				    </label>
				    <div>
				        <input type="text" name="range_end" size="32" maxlength="250" value="<?= $relation->range_end == null ? '9999' : $relation->range_end; ?>" />
				    </div>
				</div>
				<div>
				    <label for="">
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