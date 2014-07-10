<?
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? if(!$article->categories_category_id) : ?>
<script>
    // Set default value for categories radiolist
    $jQuery(document).ready(
        function(){
            $jQuery('fieldset[name=about_category_id] label:first-of-type input:radio').prop('checked', true);
        }
    );
</script>
<? endif ?>

<fieldset>
    <div>
        <label for="published"><?= translate('Published') ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $article->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><?= translate('Category') ?></legend>
    <?= helper('com:questions.radiolist.categories', array('row' => $article, 'package' => 'about', 'name' => 'about_category_id')) ?>
</fieldset>

<? if($article->isAttachable()) : ?>
<fieldset>
    <legend><?= translate('Attachments') ?></legend>
    <? if (!$article->isNew()) : ?>
        <?= import('com:attachments.view.attachments.list.html', array('attachments' => $article->getAttachments(), 'attachments_attachment_id' => $article->attachments_attachment_id)) ?>
    <? endif ?>
    <?= import('com:attachments.view.attachments.upload.html') ?>
</fieldset>
<? endif ?>
