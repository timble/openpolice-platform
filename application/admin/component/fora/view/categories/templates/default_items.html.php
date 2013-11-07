<div class="row-fluid">
    <? foreach($forums->find(array('categories_category_id' => $category->id)) as $forum) : ?>
        <div class="media__item span6">
            <i class="media__icon icon-<?= $forum->type ?> icon-2x" style="margin-top: 6px"></i>
            <h3 class="media__heading">
                <a href="<?= route('view=topics&forum='.$forum->id.'&slug='.$forum->getSlug()) ?>">
                    <?= escape($forum->title) ?>
                </a>
            </h3>
            <? if(count($topics_count->find(array('fora_forum_id' => $forum->id))) && ($count = (int) $topics_count->find(array('fora_forum_id' => $forum->id))->top()->count) >= 1) : ?>
                <small class="muted"><?= sprintf(translate('%d '.Nooku\Library\StringInflector::pluralize($forum->type)), $count) ?></small>
            <? else : ?>
                <small class="muted"><?= sprintf(@ranslate('%d '.Nooku\Library\StringInflector::pluralize($forum->type)), '0') ?></small>
            <? endif ?>
        </div>
    <? endforeach ?>
</div>