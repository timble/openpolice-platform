<title content="replace"><?= $category->title ?></title>

<h1><?= $category->title ?></h1>

<? if ($params->get('show_feed_link', 1) == 1) : ?>
    <link href="<?= route('format=rss') ?>" rel="alternate" type="application/rss+xml" />
<? endif; ?>

<ul class="categories_wrapper">
    <? foreach(object('com:articles.model.categories')->category($category->id)->getRowset() as $article) : ?>
        <li>
            <a href="<?= helper('route.article', array('row' => $article)) ?>"><?= highlight($article->title) ?></a>
        </li>
    <? endforeach; ?>
    <? foreach ($articles as $article): ?>
    <li>
        <a href="<?= helper('route.article', array('row' => $article)) ?>"><?= highlight($article->title) ?></a>
    </li>
    <? endforeach; ?>
</ul>

<? if($category->id == '6') : ?>
    <?= object('com:traffic.controller.articles')->render() ?>
<? endif ?>