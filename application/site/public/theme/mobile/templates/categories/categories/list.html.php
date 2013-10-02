<ul class="nav nav-tabs nav-stacked">
    <? foreach ($categories as $category): ?>
        <li<?= $category->slug == $state->category ? ' class="active"' : '' ?>>
            <a href="<?= helper('route.category', array('row' => $category)) ?>">
                <?= $category->title ?>
            </a>
        </li>
    <? endforeach ?>
</ul>