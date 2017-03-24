<h1><?= translate('About us') ?></h1>
<ul class="categories_wrapper">
<? foreach($categories as $category) : ?>
    <li>
        <a href="<?= helper('route.category', array('row' => $category)) ?>"><?= $category->title ?></a>
    </li>
<? endforeach; ?>
</ul>
