<fieldset>
    <legend><?= translate('Publish') ?></legend>
    <div>
        <label for="published"><?= translate('Published') ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $question->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>

<fieldset class="categories group">
    <legend><?= translate('Category') ?></legend>
    <div>
        <?= include('com:articles.view.article.default_categories.html', array('categories' =>  object('com:articles.model.categories')->sort('title')->table('questions')->getRowset(), 'article' => $question)) ?>
    </div>
</fieldset>

<? if($question->isAttachable()) : ?>
<fieldset>
    <legend><?= translate('Attachments') ?></legend>
    <? if (!$question->isNew()) : ?>
        <?= include('com:attachments.view.attachments.list.html', array('attachments' => $question->getAttachments(), 'attachments_attachment_id' => $question->attachments_attachment_id)) ?>
    <? endif ?>
    <?= include('com:attachments.view.attachments.upload.html') ?>
</fieldset>
<? endif ?>