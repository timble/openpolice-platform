<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<?= helper('behavior.keepalive') ?>
<?= helper('behavior.validator') ?>

<!--
<script src="assets://js/koowa.js" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" id="fora-topic-form" class="-koowa-form">
    <input type="hidden" name="id" value="<?= $topic->id; ?>" />
    <input type="hidden" name="published" value="0" />
    <input type="hidden" name="commentable" value="0" />

    <div class="main">
        <div class="title">
            <input class="required" type="text" name="title" maxlength="255" value="<?= $topic->title ?>" placeholder="<?= translate('Title') ?>" />
            <div class="slug">
                <span class="add-on"><?= translate('Slug'); ?></span>
                <input type="text" name="slug" maxlength="255" value="<?= $topic->slug ?>" />
            </div>
        </div>

        <?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => $topic->text, 'toolbar' => 'basic')) ?>
    </div>

    <div class="sidebar">
        <?= import('form_sidebar.html'); ?>
    </div>
</form>

<script data-inline> $jQuery(".select-forums").select2(); </script>