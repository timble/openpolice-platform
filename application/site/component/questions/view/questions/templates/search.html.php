<div class="page-header">
    <h1><?php echo @escape($params->get('page_title')); ?></h1>
</div>

<? if(!$state->category) : ?>
    <?= @template('default_search.html') ?>
<? endif ?>

<? foreach ($questions as $question): ?>
    <article>
        <div class="page-header">
            <h1>
                <a href="<?= @helper('route.question', array('row' => $question)) ?>">
                    <?= @highlight($question->title) ?>
                </a>
            </h1>
        </div>

        <?= @highlight($question->text) ?>
    </article>
<? endforeach ?>