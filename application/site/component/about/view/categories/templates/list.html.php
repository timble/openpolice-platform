<ul class="nav nav-tabs nav-stacked">
    <? foreach (object('com:about.model.categories')->table('about')->published(true)->sort('title')->getRowset() as $category): ?>
        <li<?= $category->slug == $state->category ? ' class="active"' : '' ?>>
            <a href="<?= helper('route.category', array('row' => $category)) ?>">
                <?= $category->title ?>
            </a>
        </li>
    <? endforeach ?>
</ul>