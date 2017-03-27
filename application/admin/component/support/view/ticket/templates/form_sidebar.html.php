<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? if($this->getObject('user')->getRole() == 25) : ?>
<fieldset>
    <legend><?= translate('Status') ?></legend>
    <?= helper('listbox.statuses', array('name' => 'status', 'selected' => $ticket->status)) ?>
</fieldset>
<? else : ?>
    <input type="hidden" name="commentable" value="<?= $ticket->commentable; ?>"/>
    <input type="hidden" name="status" value="<?= $ticket->status ?>"/>
<? endif ?>

<? if($ticket->isAttachable()) : ?>
<fieldset>
    <legend><?= translate('Attachments') ?></legend>
    <? if (!$ticket->isNew()) : ?>
        <?= import('com:attachments.view.attachments.list.html', array('attachments' => $ticket->getAttachments())) ?>
    <? endif ?>
    <?= import('com:attachments.view.attachments.upload.html') ?>
</fieldset>
<? endif ?>