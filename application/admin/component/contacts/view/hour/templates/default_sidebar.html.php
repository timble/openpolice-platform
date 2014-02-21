<fieldset>
    <legend><?= translate('Publish'); ?></legend>
    <div>
        <label for="published"><?= translate( 'Published' ); ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $hour->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>