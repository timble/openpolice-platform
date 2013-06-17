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
<?= @helper('behavior.modal'); ?>

<!--
<script src="media://js/koowa.js" />
-->

<ktml:module position="toolbar">
    <?= @helper('toolbar.render', array('toolbar' => $toolbar))?>
</ktml:module>

<form action="" method="post" class="-koowa-form">
	<div class="main">
		<div class="title">
		    <input id="title" class="required" type="text" name="title" size="32" maxlength="250" value="<?= $district->title; ?>" />
		</div>
		
		<div class="scrollable">
			<fieldset>
				<legend><?= @text( 'Distict' ); ?></legend>
				<div>
				    <label for="contacts_contact_id">
				    	<?= @text( 'Location' ); ?>
				    </label>
				    <div>
				        <?= @helper('com:contacts.listbox.contacts', array('autocomplete' => true, 'name' => 'contacts_contact_id', 'selected' => $district->contacts_contact_id)) ?>
				    </div>
				</div>
				<div>
				    <label for="officers">
				    	<?= @text( 'Officers' ); ?>
				    </label>
				    <div>
				        <?= @helper('listbox.officers', array('selected' => $officers, 'deselect' => false, 'attribs' => array('multiple' => 'multiple', 'class' => 'select-officers', 'style' => 'width:100%;'))); ?>
                        <script data-inline> $jQuery(".select-officers").select2(); </script>
                    </div>
				</div>
			</fieldset>
		</div>
	</div>
</form>