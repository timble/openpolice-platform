<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<?= helper('behavior.keepalive') ?>
<?= helper('behavior.validator') ?>

<!--
<script src="assets://js/koowa.js" />
-->
<script>
    if(Form && Form.Validator) {
        Form.Validator.add('validate-unsigned', {
            errorMsg: Form.Validator.getMsg("required"),
            test: function(field){
                return field.get('value').toInt() >= 0;
            }
        });
    }
</script>

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<? if($article->isTranslatable()) : ?>
    <ktml:module position="actionbar" content="append">
        <?= helper('com:languages.listbox.languages') ?>
    </ktml:module>
<? endif ?>

<form action="" method="post" id="article-form" class="-koowa-form">
    <input type="hidden" name="access" value="0" />
    <input type="hidden" name="published" value="0" />
    
    <div class="main">
        <div class="title">
            <input class="required" type="text" name="title" maxlength="255" value="<?= escape($article->title) ?>" placeholder="<?= translate('Title') ?>" />
            <div class="slug">
                <span class="add-on"><?= translate('Slug') ?></span>
                <input type="text" name="slug" maxlength="255" value="<?= escape($article->slug) ?>" />
            </div>
        </div>
        <?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => $article->text)) ?>
    </div>
    <div class="sidebar no--scrollbar">
        <?= import('default_sidebar.html'); ?>
    </div>
</form>

<script data-inline> $jQuery(".select-tags").select2(); </script>
