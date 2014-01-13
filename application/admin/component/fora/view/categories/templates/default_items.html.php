<? foreach($forums->find(array('fora_category_id' => $category->id)) as $forum) : ?>
    <div class="media__item">
        <h3 class="media__heading">
            <a href="<?= route('view=topics&forum='.$forum->id.'&slug='.$forum->getSlug()) ?>">
                <i class="media__icon icon-<?= $forum->type ?> icon-2x"></i>
                <span data-title="2 new articles"><?= escape($forum->title) ?></span>
            </a>
        </h3>
        <? if(count($topics_count->find(array('fora_forum_id' => $forum->id))) && ($count = (int) $topics_count->find(array('fora_forum_id' => $forum->id))->top()->count) >= 1) : ?>
            <small class="muted"><? // sprintf(translate('%d '.Nooku\Library\StringInflector::pluralize($forum->type)), $count) ?></small>
        <? else : ?>
            <small class="muted"><? // sprintf(@ranslate('%d '.Nooku\Library\StringInflector::pluralize($forum->type)), '0') ?></small>
        <? endif ?>
    </div>
<? endforeach ?>