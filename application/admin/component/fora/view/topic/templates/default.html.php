<style src="assets://fora/css/default.css" />

<script src="assets://fora/js/subscribe.js" />
<script src="assets://fora/js/response.js" />

<script src="assets://js/koowa.js" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<div id="fora-topic-default" class="scrollable">
    <div class="well">
        <div class="well__content" style="margin-bottom: 20px">
            <h1 class="well__heading"><?= escape($topic->title) ?></h1>
            <?= $topic->text ?>
            <? if($topic->isAttachable()):?>
                <?= import('default_attachments.html', array('attachments' => $topic->getAttachments())) ?>
            <?endif;?>

            <? if($forum->type == 'idea') : ?>
            <hr />
            <div class="muted" style="line-height: 46px;">
                <?= import('default_vote.html'); ?>
            </div>
            <?endif;?>
        </div>

        <?if($forum->type != 'article' && $answer->id):?>
            <div class="well__content anwser">
                <div class="comment">
                    <div class="comment-header">
                        <?= $awnser->created_by == $fora_user->id ? translate('You') : $awnser->created_by_name ?>&nbsp;<?= translate('wrote') ?>
                        <time datetime="<?= $awnser->created_on ?>" pubdate><?= helper('date.humanize', array('date' => $awnser->created_on)) ?></time>
                    </div>
                    <div class="btn-group" style="float: right">
                        <? if(object('user')->getRole() == 25 ):?>
                        <button title="<?=translate('Unmark as') ?>"
                                class="btn response"
                                data-topic="<?=$topic->id;?>"
                                data-comment="<?= $awnser->id ?>" data-action="delete">
                            <i class="icon-remove"></i>
                        </button>
                        <?endif;?>
                    </div>
                    <p><?= escape($answer->text) ?></p>
                </div>
            </div>
        <?endif;?>
        <div class="well__content comments">
        <? foreach($comments as $comment) :?>
            <div class="comment comment_<?=$comment->id;?>">
                <div class="comment__header">
                    <?= $comment->created_by == $fora_user->id ? translate('You') : $comment->created_by_name ?>&nbsp;<?= translate('wrote') ?>
                    <time datetime="<?= $comment->created_on ?>" pubdate><?= helper('date.humanize', array('date' => $comment->created_on)) ?></time>
                </div>
                <div class="btn-group" style="float: right">
                    <? if($forum->type != 'article') : ?>
                        <button title="<?=translate($comment->responded ? 'Unmark as' : 'Mark as') ?>"
                                class="btn btn-small response"
                                data-topic="<?=$topic->id;?>"
                                data-comment="<?= $comment->id ?>" data-action="<?= $comment->id == $answer->id ? 'delete' : 'post' ?>">
                            <i class="<?= $comment->id == $answer->id ? 'icon-remove' : 'icon-ok'?> "></i>
                        </button>
                    <? endif ?>
                </div>
                <div class="comment__text">
                    <?= $comment->text ?>
                </div>
            </div>
        <? endforeach ?>
        <? if($topic->commentable == 1):?>
            <form action="<?= route('&view=comment&row='.$topic->id.'&table=fora') ?>" method="post">
                <input type="hidden" name="fora_topic_id" value="<?= $topic->id ?>" />

                <?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => '', 'toolbar' => 'basic')) ?>

                <br />
                <input class="btn" type="submit" value="<?= translate('Submit') ?>"/>
            </form>
        <?endif;?>
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

        new Fora.Response({
            holder: 'fora-topic-default',
            url: 'index.php?option=com_fora&view=respond',
            data: {
                _token: '<?= object('user')->getSession()->getToken() ?>'
            }
        });

    });
</script>

