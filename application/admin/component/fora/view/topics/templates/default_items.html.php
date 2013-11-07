<div class="media__item">
    <div class="media__icon" style="margin-top: 10px">
        <? if($topic->forum_type != 'article' && ($topic->responded || $topic->status == 'done')) : ?>
            <i class="icon-ok icon-large color-green"></i>
        <? else : ?>
            <i class="icon-<?= $topic->forum_type ?> icon-large"></i>
        <? endif ?>

        <div class="vote"><i class="icon-thumbs-up"></i> <?= $topic->votes ?></div>
    </div>
    <div class="media-body">
        <h3>
            <a href="<?= route('view=topic&&id='.$topic->id.'&slug='.$topic->slug) ?>">
                <?= escape($topic->title) ?>
            </a>
        </h3>

        <div class="pull-right">
            <? if(in_array($topic->forum_type, array('issue', 'idea')) && !empty($topic->status)): ?>
                <span class="label label-<?= $topic->status ?>"><?= $topic->status ?></span>
            <? endif; ?>
        </div>

        <small class="muted">
            <strong><?= helper('date.humanize', array('date' => $topic->created_on)) ?></strong> <?= translate('by') ?> <?= escape($topic->created_by_name) ?>
        </small>
    </div>
</div>