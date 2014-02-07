<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
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