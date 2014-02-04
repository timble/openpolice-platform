<ul class="navigation">
    <li>
        <a class="<?= $state->forum == null ? 'active' : ''; ?>" href="<?= route('forum=' ) ?>">
            <?= 'All forums' ?>
        </a>
    </li>
    <? foreach ($forums as $forum) : ?>
        <li>
            <a class="<?= $state->forum == $forum->id ? 'active' : ''; ?>" href="<?= route('forum='.$forum->id ) ?>">
                <?= escape($forum->title) ?>
            </a>
        </li>
    <? endforeach ?>
</ul>