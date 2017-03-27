<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? $disabled = $this->getObject('user')->getRole() < 25 ?>

<?= helper('behavior.validator') ?>

<!--
<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<? if($section->isTranslatable()) : ?>
    <ktml:module position="actionbar" content="append">
        <?= helper('com:languages.listbox.languages', array('attribs' => array('disabled' => 'true'))) ?>
    </ktml:module>
<? endif ?>

<form action="" method="post" class="-koowa-form" id="section-form">
    <input type="hidden" name="published" value="0" />

    <div class="main">
        <div class="title">
            <input <?= $disabled ? 'disabled' : '' ?> class="required" type="text" name="title" maxlength="255" value="<?= $section->title; ?>" placeholder="<?= translate( 'Title' ); ?>" />
            <div class="slug">
                <span class="add-on"><?= translate('Slug'); ?></span>
                <input <?= $disabled ? 'disabled' : '' ?> type="text" name="slug" maxlength="255" value="<?= $section->slug ?>" />
            </div>
        </div>
        <?= object('com:ckeditor.controller.editor')->render(array('name' => 'description', 'text' => $section->description, 'toolbar' => 'basic')) ?>
    </div>

    <div class="sidebar">
        <?= import('default_sidebar.html'); ?>
    </div>
</form>
