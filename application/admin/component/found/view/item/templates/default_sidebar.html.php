<?
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? if(!$item->found_category_id) : ?>
    <script>
        // Set default value for categories radiolist
        $jQuery(document).ready(
            function(){
                $jQuery('fieldset[name=found_category_id] label:first-of-type input:radio').prop('checked', true);
            }
        );
    </script>
<? endif ?>

<fieldset>
    <legend><?= translate('Publish') ?></legend>
    <div>
        <label for="published"><?= translate('Published') ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $item->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>

<? if($item->isAttachable()) : ?>
    <fieldset>
        <legend><?= translate('Attachments') ?></legend>
        <? if (!$item->isNew()) : ?>
            <?= import('com:attachments.view.attachments.list.html', array('attachments' => $item->getAttachments(), 'attachments_attachment_id' => $item->attachments_attachment_id)) ?>
        <? endif ?>
        <?= import('com:attachments.view.attachments.upload.html') ?>
    </fieldset>
<? endif ?>