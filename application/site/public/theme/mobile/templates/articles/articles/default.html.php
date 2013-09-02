<title content="replace"><?= $category->title ?></title>

<? if ($params->get('show_feed_link', 1) == 1) : ?>
    <link href="<?= route('format=rss') ?>" rel="alternate" type="application/rss+xml" />
<? endif; ?>

<? foreach ($articles as $article): ?>
<div class="article">
    <h1 class="article__header">
        <a href="<?= helper('route.article', array('row' => $article)) ?>"><?= highlight($article->title) ?></a>
    </h1>

    <img align="right" src="<?= $article->thumbnail ?>" />

    <? if ($article->introtext) : ?>
        <?= $article->introtext ?>
        <a class="article__readmore" href="<?= helper('route.article', array('row' => $article)) ?>"><?= translate('Read more') ?></a>
    <? endif; ?>
</div>
<? endforeach; ?>

<?= helper('paginator.pagination', array('total' => $total, 'show_limit' => false, 'show_count' => false)); ?>

