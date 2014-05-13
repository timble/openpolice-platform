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

<? if($state->table != 'questions') : ?>
<? if($category->isAttachable()) : ?>
    <fieldset>
        <legend><?= translate('Image') ?></legend>
        <? if (!$category->isNew()) : ?>
            <?= import('com:attachments.view.attachments.list.html', array('attachments' => $category->getAttachments(), 'assignable' => false)) ?>
        <? endif ?>
        <? if(!count($category->getAttachments())) : ?>
            <?= import('com:attachments.view.attachments.upload.html') ?>
        <? endif ?>
    </fieldset>
<? endif ?>
<? endif ?>