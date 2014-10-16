<? if(!$state->category) : ?>
    <?= import('com:questions.view.questions.default_search.html') ?>
<? endif ?>

<ul class="nav nav--pills column--triple">
    <? foreach ($categories as $category): ?>
        <li>
            <a href="<?= helper('route.category', array('row' => $category)) ?>">
                <?= $category->title ?>
            </a>
        </li>
    <? endforeach ?>
</ul>