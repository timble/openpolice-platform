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
<?= helper('behavior.modal'); ?>

<!--
<script src="assets://js/koowa.js" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" class="-koowa-form">
	<div class="main">
		<div class="title">
		    <input id="title" class="required" type="text" name="title" size="32" maxlength="250" value="<?= $district->title; ?>" />
		</div>
		
		<div class="scrollable">
			<fieldset>
				<legend><?= translate( 'District' ); ?></legend>
                <div>
                    <label for="id">
                        <?= translate( 'ID' ); ?>
                    </label>
                    <div>
                        <input type="text" name="id" maxlength="250" class="required" value="<?= $district->id; ?>" />
                    </div>
                </div>
                <div>
				    <label for="contacts_contact_id">
				    	<?= translate( 'Contact' ); ?>
				    </label>
				    <div>
				        <?= helper('com:contacts.listbox.contacts', array('autocomplete' => true, 'name' => 'contacts_contact_id', 'selected' => $district->contacts_contact_id)) ?>
				    </div>
				</div>
				<div>
				    <label for="officers">
				    	<?= translate( 'Officers' ); ?>
				    </label>
				    <div>
				        <?= helper('listbox.officers', array('selected' => $officers, 'deselect' => false, 'attribs' => array('multiple' => 'multiple', 'class' => 'select-officers required', 'style' => 'width:100%;'))); ?>
                        <script data-inline> $jQuery(".select-officers").select2(); </script>
                    </div>
				</div>
			</fieldset>
		</div>
	</div>
</form>