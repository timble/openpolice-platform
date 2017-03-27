<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<?= helper('behavior.keepalive') ?>
<?= helper('behavior.validator') ?>

<script src="assets://js/koowa.js" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="post" id="support-ticket-form" class="-koowa-form">
    <input type="hidden" name="id" value="<?= $ticket->id; ?>" />
    <input type="hidden" name="published" value="0" />
    <input type="hidden" name="commentable" value="0" />

    <div class="main">
        <div class="title">
            <input class="required" type="text" name="title" maxlength="255" value="<?= $ticket->title ?>" placeholder="<?= translate('Title') ?>" />
        </div>

        <?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => $ticket->text, 'toolbar' => 'basic', 'attribs' => array('class' => 'ckeditor-required'))) ?>
    </div>

    <div class="sidebar">
        <?= import('form_sidebar.html'); ?>
    </div>
</form>