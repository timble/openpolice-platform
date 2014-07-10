<?= helper('behavior.validator') ?>

<!--
<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<? if($category->isTranslatable()) : ?>
<ktml:module position="actionbar" content="append">
    <?= helper('com:languages.listbox.languages') ?>
</ktml:module>
<? endif ?>

<form action="" method="post" class="-koowa-form" id="category-form">
    <input type="hidden" name="access" value="0" />
    <input type="hidden" name="published" value="0" />
    <input type="hidden" name="table" value="<?= $state->table ?>" />
    <input type="hidden" name="attachments_attachment_id" value="0" />

    <div class="main">
        <div class="title">
            <input class="required" type="text" name="title" maxlength="255" value="<?= $category->title; ?>" placeholder="<?= translate( 'Title' ); ?>" />
            <div class="slug">
                <span class="add-on"><?= translate('Slug'); ?></span>
                <input type="text" name="slug" maxlength="255" value="<?= $category->slug ?>" />
            </div>
        </div>
    </div>

    <div class="sidebar">
        <?= import('default_sidebar.html'); ?>
    </div>
</form>