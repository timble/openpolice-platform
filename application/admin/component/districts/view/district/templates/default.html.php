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
		    <input id="title" class="required" type="text" name="title" size="32" maxlength="250" value="<?= $district->title; ?>" placeholder="<?= translate('Title') ?>" />
		</div>

		<div class="scrollable">
			<fieldset>
				<legend><?= translate( 'Required' ); ?></legend>
                <div>
				    <label for="contacts_contact_id">
				    	<?= translate( 'Police station' ); ?>
				    </label>
				    <div>
                        <?= helper('com:contacts.listbox.contacts', array('name' => 'contacts_contact_id', 'selected' => $district->contacts_contact_id, 'deselect' => false, 'filter' => array('category' => '1'), 'attribs' => array('class' => 'select-contacts required', 'style' => 'width:100%;'))); ?>
                        <script data-inline> $jQuery(".select-contacts").select2(); </script>
                    </div>
				</div>
				<div>
				    <label for="officers">
				    	<?= translate( 'District officer' ); ?>
				    </label>
				    <div>
				        <?= helper('listbox.officers', array('selected' => $officers, 'deselect' => false, 'attribs' => array('multiple' => 'multiple', 'class' => 'select-officers required', 'style' => 'width:100%;'))); ?>
                        <script data-inline> $jQuery(".select-officers").select2(); </script>
                    </div>
				</div>
			</fieldset>
            <fieldset>
                <legend><?= translate( 'Optional' ); ?></legend>
                <div>
                    <label for="islp">
                        <?= translate( 'ISLP ID' ); ?>
                    </label>
                    <div>
                        <input type="text" name="islp" maxlength="250" value="<?= $district->islp; ?>" />
                    </div>
                </div>
                <div>
                    <label for="email">
                        <?= translate( 'Email' ); ?>
                    </label>
                    <div>
                        <input type="text" name="email" maxlength="250" value="<?= $district->email; ?>" />
                    </div>
                </div>
            </fieldset>
		</div>
	</div>
</form>
