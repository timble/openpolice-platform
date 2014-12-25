<ul class="nav nav--list">
    <? foreach ($sections as $section): ?>
        <li<?= $section->slug == $state->section && !$state->category ? ' class="active"' : '' ?>>
            <a href="<?= helper('route.section', array('row' => $section)) ?>">
                <?= $section->title ?>
            </a>
            <? if($state->section == $section->slug) : ?>
                <ul>
                    <? foreach ($categories->find(array('wanted_section_id' => $section->id)) as $category) : ?>
                        <li<?= $category->slug == $state->category ? ' class="active"' : '' ?>>
                            <a href="<?= helper('route.category', array('row' => $category)) ?>">
                                <?= $category->title ?>
                            </a>
                        </li>
                    <? endforeach ?>
                </ul>
            <? endif ?>
        </li>
    <? endforeach ?>
</ul>