<style src="assets://fora/css/default.css" />

<script src="assets://fora/js/subscribe.js" />
<script src="assets://js/koowa.js" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<div id="fora-topic-default" class="scrollable">
    <div class="well">
        <div class="well__content" style="margin-bottom: 20px">
            <h1>
                <?= escape($topic->title) ?>
                <? if($topic->status) : ?>
                    <span class="label label-<?= $topic->status ?>"><?= translate($topic->status) ?></span>
                <? endif; ?>
            </h1>
            <?= $topic->created_by_name ?><br />
            <?= translate('Posted this on') ?> <?= $topic->created_on ?>
            <?= $topic->text ?>
            <? if($topic->isAttachable()) : ?>
                <?= import('default_attachments.html', array('attachments' => $topic->getAttachments())) ?>
            <? endif; ?>
            <? if($forum->type == 'idea') : ?>
            <hr />
            <div class="muted" style="line-height: 46px;">
                <?= import('default_vote.html'); ?>
            </div>
            <? endif; ?>
        </div>
        <div class="well__content comments">
        <? foreach($comments as $comment) : ?>
            <div class="comment comment_<?=$comment->id;?>">
                <div class="comment__header">
                    <?= $comment->created_by == $fora_user->id ? translate('You') : $comment->created_by_name ?>&nbsp;<?= translate('wrote') ?>
                    <time datetime="<?= $comment->created_on ?>" pubdate><?= helper('date.humanize', array('date' => $comment->created_on)) ?></time>
                </div>
                <div class="comment__text">
                    <?= $comment->text ?>
                </div>
            </div>
        <? endforeach; ?>
        <? if($topic->commentable == 1) : ?>
            <form action="<?= route('&view=comment&row='.$topic->id.'&table=fora') ?>" method="post">
                <input type="hidden" name="fora_topic_id" value="<?= $topic->id ?>" />
                <?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => '', 'toolbar' => 'basic')) ?>
                <br />
                <input class="btn" type="submit" value="<?= translate('Submit') ?>"/>
            </form>
        <? endif; ?>
        </div>
    </div>
</div>
<script>
    jQuery( document ).ready(function($) {
        new Fora.Subscribe({
            holder: 'fora-topic-default',
            url: '<?= html_entity_decode(route('view=subscription'))?>',
            data: {
                _token: '<?= object('user')->getSession()->getToken() ?>'
            }
        });
    });
</script>

