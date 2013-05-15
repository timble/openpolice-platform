<fieldset class="form-horizontal">
    <legend><?= @text('Publish') ?></legend>
    <div class="control-group">
        <label class="control-label" for="published"><?= @text('Published') ?></label>
        <div class="controls">
            <input type="checkbox" name="published" value="1" <?= $article->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
</fieldset>

<fieldset class="categories group">
    <legend><?= @text('Category') ?></legend>
    <div class="control-group">
        <?= @template('com:articles.view.article.default_categories.html', array('categories' =>  @object('com:articles.model.categories')->sort('title')->table('questions')->getRowset(), 'article' => $article)) ?>
    </div>
</fieldset>

<? if($article->isTaggable()) : ?>
    <fieldset>
        <legend><?= @text('Tags') ?></legend>
        <div class="control-group">
            <label class="control-label" for="created_by"><?= @text('Tags') ?></label>
            <div class="controls">
                <?= @helper('com:terms.listbox.terms', array('name' => 'terms[]', 'selected' => $article->getTerms()->terms_term_id, 'filter' => array('table' => 'questions'), 'attribs' => array('class' => 'select-terms', 'multiple' => 'multiple', 'style' => 'width:220px'))) ?>
                <script data-inline> $jQuery(".select-terms").select2(); </script>
            </div>
        </div>
    </fieldset>
<? endif ?>