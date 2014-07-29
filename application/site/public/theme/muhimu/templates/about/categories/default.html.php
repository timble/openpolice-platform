<ul class="nav nav--pills nav--visited">
<? foreach($categories as $category) : ?>
    <li>
        <a href="<?= helper('route.category', array('row' => $category)) ?>"><?= $category->title ?></a>
    </li>
<? endforeach; ?>
</ul>
