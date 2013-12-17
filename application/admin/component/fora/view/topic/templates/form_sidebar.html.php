<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>
<?if($this->getObject('user')->getRole() == 25):?>
<fieldset>
    <legend><?= translate('Publish'); ?></legend>
    <div>
        <label for="published"><?= translate( 'Published' ); ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $topic->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
    <div>
        <label for="commentable"><?= translate( 'Commentable' ); ?></label>
        <div>
            <input type="checkbox" name="commentable" value="1" <?= $topic->commentable ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>
<fieldset>
    <legend><?= translate('Forum') ?></legend>
    <?= helper('listbox.forums', array('name' => 'fora_forum_id', 'selected' => $topic->fora_forum_id ? $topic->fora_forum_id : $state->forum, 'attribs' => array('class' => 'select-forums required',  'style' => 'width:220px'))) ?>
</fieldset>
<?else:?>
    <input type="hidden" name="published" value="1"/>
    <input type="hidden" name="commentable" value="<?= $topic->commentable;?>"/>
    <input type="hidden" name="fora_forum_id" value="<?=$topic->fora_forum_id ? $topic->fora_forum_id : $state->forum;?>"/>
<?endif;?>

<? if($topic->isAttachable()) : ?>
<fieldset>
    <legend><?= translate('Attachments') ?></legend>
    <? if (!$topic->isNew()) : ?>
        <?= import('com:attachments.view.attachments.list.html', array('attachments' => $topic->getAttachments(), 'attachments_attachment_id' => $topic->attachments_attachment_id)) ?>
    <? endif ?>
    <?= import('com:attachments.view.attachments.upload.html') ?>
</fieldset>
<? endif ?>