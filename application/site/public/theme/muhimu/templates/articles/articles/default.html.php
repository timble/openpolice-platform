<title content="replace"><?= $category->title ?></title>

<h1><?= $category->title ?></h1>

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
