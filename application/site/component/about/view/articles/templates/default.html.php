<ktml:module position="left">
    <?= import('com:about.view.categories.list.html') ?>
</ktml:module>

<? foreach ($articles as $article) : ?>
<div class="article">
    <h1 class="article__header">
        <? if($article->fulltext) : ?>
        <a href="<?= helper('route.article', array('row' => $article)) ?>">
            <?= $article->title ?>
        </a>
        <? else : ?>
            <?= $article->title ?>
        <? endif; ?>
    </h1>
    <?= $article->introtext ?>
    <? if($article->fulltext) : ?>
    <a class="article__readmore" href="<?= helper('route.article', array('row' => $article)) ?>">
        <?= translate('Read more') ?>
    </a>
    <? endif; ?>
</div>
<? endforeach; ?>