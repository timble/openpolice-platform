<style src="assets://fora/css/default.css" />

<script src="assets://fora/js/subscribe.js" />
<script src="assets://fora/js/response.js" />



<div id="com_fora" class="scrollable">
    <div id="fora-topic-default" class="span9">
        <div class="well well-small">
            <?= import('com:fora.module.breadcrumbs.default.html', array('list' => $pathways)) ?>
        </div>
        <div class="well well-small">
            <div class="well__frame">
                <h1 class="well__heading well__heading--left"><?= escape($topic->title) ?></h1>
                <div class="well__toolbar">
                    <div class="btn-group">
                        <? if($topic->created_by == $fora_user->id) : ?>
                            <a class="btn btn-small" href="<?= route('layout=form&id='.$topic->id) ?>">Edit</a>
                        <? endif ?>
                        <button type="button" class="btn btn-small dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="modal" href="<?=  route('view=categories&topic='.$topic->id.'&layout=select&tmpl=component') ?>" rel="{size: {x:600, y:450}}"><?= translate('Move') ?></a></li>
                            <li><a onclick="javascript: var form = $('form-delete'); if(form.onsubmit()) { form.submit(); }"><?= translate('Delete') ?></a></li>
                        </ul>
                        <form action="" method="POST" class="-koowa-form" id="form-delete" onsubmit="return confirm('<?= addslashes(translate('Are you sure you want to delete this topic?')) ?>');">
                            <input type="hidden" name="action" value="delete" />
                        </form>
                    </div>
                    <button type="button" class="btn btn-small subscribe <?= $subscription ? 'btn-subscribed' : 'btn-unsubscribed' ?>" title="Click to manage your subscription"
                        data-row="<?=$topic->id;?>"
                        data-action="<?= $subscription ? 'delete' : 'post' ?>"
                        data-type="topic">
                        <i class="icon-star"></i>
                    </button>
                </div>
            </div>
            <div class="well__content">
                <?= $topic->text ?>
                <? if($topic->isAttachable()):?>
                    <?= import('default_attachments.html', array('attachments' => $topic->getAttachments())) ?>
                <?endif;?>
                <hr />
                <div class="row-fluid">
                    <div class="muted pull-right" style="line-height: 46px;">
                        <?= import('default_vote.html'); ?>
                    </div>
                </div>
            </div>
        </div>
        <? if($forum->type != 'article' && $awnser->id) : ?>
            <div class="well well-small">
                <div class="comment well">
                    <div class="comment-header">
                        <?= $awnser->created_by == $fora_user->id ? translate('You') : $awnser->created_by_name ?>&nbsp;<?= translate('wrote') ?>
                        <time datetime="<?= $awnser->created_on ?>" pubdate><?= helper('date.humanize', array('date' => $awnser->created_on)) ?></time>
                    </div>
                    <div class="btn-group" style="float: right">
                        <? if(object('user')->getRole() == 25 ):?>
                        <button title="<?=translate('Unmark as') ?>"
                                class="btn btn-small response"
                                data-topic="<?=$topic->id;?>"
                                data-id="<?= $awnser->id ?>" data-action="delete">
                            <i class="icon-remove"></i>
                        </button>
                        <?endif;?>
                    </div>
                    <p><?= escape($awnser->text) ?></p>
                </div>
            </div>
        <?endif;?>
        <? if($topic->commentable == 1):?>
            <form action="<?= route('&view=comment&row='.$topic->id.'&table=fora') ?>" method="post">
                <input type="hidden" name="fora_topic_id" value="<?= $topic->id ?>" />

                <textarea type="text" name="text" placeholder="<?= translate('Add new comment here ...') ?>" id="new-comment-text"></textarea>
                <br />
                <input class="button" type="submit" value="<?= translate('Submit') ?>"/>
            </form>
        <?endif;?>
        <? foreach($comments as $comment) :?>
            <div class="comment well">
                <div class="comment-header">
                    <?= $comment->created_by == $fora_user->id ? translate('You') : $comment->created_by_name ?>&nbsp;<?= translate('wrote') ?>
                    <time datetime="<?= $comment->created_on ?>" pubdate><?= helper('date.humanize', array('date' => $comment->created_on)) ?></time>
                </div>
                <div class="btn-group" style="float: right">
                    <? if($forum->type != 'article') : ?>
                        <button title="<?=translate($comment->responded ? 'Unmark as' : 'Mark as') ?>"
                                class="btn btn-small response"
                                data-topic="<?=$topic->id;?>"
                                data-id="<?= $comment->id ?>" data-action="<?= $comment->id == $awnser->id ? 'delete' : 'post' ?>">
                            <i class="<?= $comment->id == $awnser->id ? 'icon-remove' : 'icon-ok'?> "></i>
                        </button>
                    <? endif ?>
                </div>
                <p><?= escape($comment->text) ?></p>
            </div>
        <? endforeach ?>

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
            url: '<?= html_entity_decode(route('view=respond&type=topic')) ?>',
            data: {
                _token: '<?= object('user')->getSession()->getToken() ?>'
            }
        });

    });
</script>

