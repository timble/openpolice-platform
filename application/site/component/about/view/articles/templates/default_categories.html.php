<ul class="<?= $class ?>">
    <? foreach ($categories as $category): ?>
        <li<?= $category->id == $selected ? ' class="active"' : '' ?>>
            <a href="<?= helper('route.category', array('row' => $category)) ?>">
                <?= $category->title ?>
            </a>
        </li>
    <? endforeach ?>
</ul>