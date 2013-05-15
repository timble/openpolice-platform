<?
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<?= @helper('behavior.validator'); ?>

<!--
<script src="media://js/koowa.js" />
-->

<ktml:module position="toolbar">
    <?= @helper('toolbar.render', array('toolbar' => $toolbar))?>
</ktml:module>

<form action="" method="post" class="-koowa-form">
	<div class="main">
		<div class="title">
		    <input class="required" type="text" name="title" maxlength="255" value="<?= $street->title ?>" placeholder="<?= @text('Title') ?>" />
		</div>
	
		<div class="scrollable">
			<fieldset class="form-horizontal">
				<legend><?= @text( 'Information' ); ?>:</legend>
				<div class="control-group">
				    <label class="control-label" for="name">
				    	<?= @text( 'Municipality' ); ?>
				    </label>
				    <div class="controls">
				        <?= @helper('com:police.listbox.municipalities', array('deselect' => false, 'filter' => array('zone' => '5388'))) ?>
				    </div>
				</div>
			</fieldset>
		</div>
	</div>
</form>