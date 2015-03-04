<? if(!$question->questions_category_id) : ?>
<script>
    // Set default value for categories radiolist
    $jQuery(document).ready(
        function(){
            $jQuery('fieldset[name=questions_category_id] label:first-of-type input:radio').prop('checked', true);
        }
    );
</script>
<? endif ?>

<fieldset>
    <legend><?= translate('Publish') ?></legend>
    <div>
        <label for="published"><?= translate('Published') ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $question->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><?= translate('Category') ?></legend>
    <?= helper('com:questions.radiolist.categories', array('row' => $question)) ?>
</fieldset>

<? if($question->isAttachable()) : ?>
<fieldset>
    <legend><?= translate('Attachments') ?></legend>
    <? if (!$question->isNew()) : ?>
        <?= import('com:attachments.view.attachments.list.html', array('attachments' => $question->getAttachments(), 'attachments_attachment_id' => $question->attachments_attachment_id)) ?>
    <? endif ?>
    <?= import('com:attachments.view.attachments.upload.html') ?>
</fieldset>
<? endif ?>

<fieldset>
    <legend><?= translate('Embeds') ?></legend>
    <div>
        <label for="params[youtube]"><?= translate('Youtube') ?></label>
        <div>
            <input type="text" name="params[youtube]" value="<?= $question->params['youtube'] ?>" placeholder="http://youtu.be/hPxxxgI_7LY" />
        </div>
    </div>
</fieldset>