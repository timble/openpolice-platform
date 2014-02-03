<fieldset>
    <legend><?= translate( 'Publish' ); ?></legend>
    <div>
        <label for="published"><?= translate('Published') ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $category->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>
<? if($state->table == 'articles') : ?>
    <fieldset class="categories group">
        <legend><?= translate('Parent') ?></legend>
        <div>
            <?= helper('com:categories.radiolist.categories', array('row' => $category, 'name' => 'parent_id', 'filter' => array('parent' => '0', 'table' => $state->table))) ?>
        </div>
    </fieldset>
<? endif ?>

<? if($category->isAttachable()) : ?>
    <fieldset>
        <legend><?= translate('Image') ?></legend>
        <? if (!$category->isNew()) : ?>
            <?= import('com:attachments.view.attachments.list.html', array('attachments' => $category->getAttachments(), 'attachments_attachment_id' => $category->attachments_attachment_id)) ?>
        <? endif ?>
        <?= import('com:attachments.view.attachments.upload.html') ?>
    </fieldset>
<? endif ?>