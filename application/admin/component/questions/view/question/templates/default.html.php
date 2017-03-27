<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<?= helper('behavior.validator'); ?>

<script src="assets://js/koowa.js" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<? if($question->isTranslatable()) : ?>
<ktml:module position="actionbar" content="append">
    <?= helper('com:languages.listbox.languages', array('attribs' => array('disabled' => 'true'))) ?>
</ktml:module>
<? endif ?>

<form action="" method="post" class="-koowa-form" enctype="multipart/form-data">
	<input type="hidden" name="published" value="0" />
    <input type="hidden" name="attachments_attachment_id" value="0" />
	
	<div class="main">
		<div class="title">
			<input class="required" type="text" name="title" maxlength="255" value="<?= $question->title ?>" placeholder="<?= translate('Title') ?>" />
			<div class="slug">
			    <span class="add-on">Slug</span>
			    <input type="text" name="slug" maxlength="255" value="<?= $question->slug ?>" />
			</div>
		</div>
		
		<?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => $question->text, 'removeButtons' => 'readmore', 'attribs' => array('class' => 'ckeditor-required'))) ?>
	</div>
	<div class="sidebar">
	    <?= import('default_sidebar.html') ?>
    </div>
</form>
