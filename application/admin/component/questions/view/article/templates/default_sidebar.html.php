<fieldset>
    <legend><?= @text('Publish') ?></legend>
    <div>
        <label for="published"><?= @text('Published') ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $article->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>

<fieldset class="categories group">
    <legend><?= @text('Category') ?></legend>
    <div>
        <?= @template('com:articles.view.article.default_categories.html', array('categories' =>  @object('com:articles.model.categories')->sort('title')->table('questions')->getRowset(), 'article' => $article)) ?>
    </div>
</fieldset>