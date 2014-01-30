<? if(!$contact->categories_category_id) : ?>
<script>
    // Set default value for categories radiolist
    $jQuery(document).ready(
        function(){
            $jQuery('fieldset[name=categories_category_id] label:first-of-type input:radio').prop('checked', true);
        }
    );
</script>
<? endif ?>

<fieldset>
    <legend><?= translate('Publish'); ?></legend>
    <div>
        <label for="published"><?= translate( 'Published' ); ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $contact->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><?= translate('Category') ?></legend>
    <?= helper('com:categories.radiolist.categories', array('row' => $contact, 'name' => 'categories_category_id')) ?>
</fieldset>

<? if($contact->isAttachable()) : ?>
<fieldset>
    <legend><?= translate('Attachments'); ?></legend>
    <? if (!$contact->isNew()) : ?>
        <?= import('com:attachments.view.attachments.list.html', array('attachments' => $contact->getAttachments(), 'assignable' => false)) ?>
    <? endif ?>
    <? if(!count($contact->getAttachments())) : ?>
        <?= import('com:attachments.view.attachments.upload.html') ?>
    <? endif ?>
</fieldset>
<? endif ?>