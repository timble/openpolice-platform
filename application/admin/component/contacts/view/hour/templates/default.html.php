<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<?= helper('behavior.validator'); ?>

<script src="assets://js/koowa.js" />
<script src="assets://news/js/jquery.datetimepicker.js" />
<style src="assets://news/css/jquery.datetimepicker.css" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" class="-koowa-form">
	<div class="main">
		<div class="scrollable">
			<fieldset>
				<legend><?= translate( 'Information' ); ?></legend>
				<div>
				    <label for="name">
				    	<?= translate( 'Location' ); ?>
				    </label>
				    <div>
				        <?= helper('listbox.contacts', array('name' => 'contacts_contact_id', 'selected' => $hour->contacts_contact_id, 'attribs' => array('id' => 'select-contact', 'class' => 'required', 'style' => 'width:100%'))) ?>
                        <script data-inline> $jQuery("#select-contact").select2(); </script>
                    </div>
				</div>
				<div>
				    <label for="name">
				    	<?= translate( 'Day of Week' ); ?>
				    </label>
				    <div>
				        <?= helper('listbox.days', array('name' => 'day_of_week')) ?>
				    </div>
				</div>
				<div>
				    <label for="opening_time">
				    	<?= translate( 'Opening Time' ); ?>
				    </label>
				    <div>
                        <input name="opening_time" type="text" value="<?= $hour->opening_time; ?>" id="opening_time" />
                        <script data-inline> $jQuery("#opening_time").datetimepicker({datepicker:false, format:'H:i'}); </script>
				    </div>
				</div>
				<div>
				    <label for="closing_time">
				    	<?= translate( 'Closing Time' ); ?>
				    </label>
				    <div>
				        <input name="closing_time" type="text" value="<?= $hour->closing_time; ?>" id="closing_time" />
                        <script data-inline> $jQuery("#closing_time").datetimepicker({datepicker:false, format:'H:i'}); </script>
				    </div>
				</div>
			</fieldset>
		</div>
	</div>
</form>