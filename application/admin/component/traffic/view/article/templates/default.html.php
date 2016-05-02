<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<?= helper('behavior.validator'); ?>

<script src="assets://news/js/jquery.datetimepicker.js" />
<style src="assets://news/css/jquery.datetimepicker.css" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<? if($article->isTranslatable()) : ?>
<ktml:module position="actionbar" content="append">
    <?= helper('com:languages.listbox.languages', array('attribs' => array('disabled' => 'true'))) ?>
</ktml:module>
<? endif ?>

<!--
<script src="assets://js/koowa.js" />
-->

<form action="" method="post" class="-koowa-form">	
	<input type="hidden" name="published" value="0" />
	
	<div class="main">
        <div class="title">
            <input class="required" type="text" name="title" maxlength="255" value="<?= escape($article->title) ?>" placeholder="<?= translate('Title') ?>" />
            <div class="slug">
                <span class="add-on">Slug</span>
                <input type="text" name="slug" maxlength="255" value="<?= escape($article->slug) ?>" />
            </div>
        </div>
		
		<?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => $article->text, 'removeButtons' => 'readmore')) ?>
	</div>
	<div class="sidebar" style="padding-bottom: 200px">
        <?= import('default_sidebar.html') ?>
    </div>
</form>
