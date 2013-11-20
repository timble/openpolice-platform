<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>
<style src="assets://fora/css/default.css" />

<script src="assets://fora/js/subscribe.js" />
<div id="com_fora">
    <div id="fora-topic-default" class="span9">
        <div class="well well-small">
            <div class="well__frame">
                <h1 class="well__heading well__heading--left"><?= escape($topic->title) ?></h1>
                <div class="well__toolbar">
                    <div class="btn-group">
                        <? if($topic->created_by == $this->getObject('user')->getId()) : ?>
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

                        <button type="button" class="btn btn-small subscribe <?= $subscription ? 'btn-subscribed' : 'btn-unsubscribed' ?>" title="Click to manage your subscription">
                            <i class="icon-star"></i>
                        </button>

                </div>
            </div>
            <div class="well__content">
                <?= $topic->text ?>
                <?//= @template('com://site/fora.view.attachments.default') ?>
                <hr />
                <div class="row-fluid">
                    <div class="muted pull-right" style="line-height: 46px;">
                        <?= import('default_vote.html'); ?>
                    </div>
                </div>

            </div>
        </div>
        <form action="<?= route('&view=comment&row='.$topic->id.'&table=fora') ?>" method="post">
            <input type="hidden" name="row" value="<?= $topic->id ?>" />
            <input type="hidden" name="table" value="fora" />

            <textarea type="text" name="text" placeholder="<?= translate('Add new comment here ...') ?>" id="new-comment-text"></textarea>
            <br />
            <input class="button" type="submit" value="<?= translate('Submit') ?>"/>
        </form>
        <? //if($forum->type == 'issue'): ?>
            <?//= @template('default_note') ?>
        <? //endif; ?>
        <? foreach($comments as $comment) :?>
            <div class="comment">
                <div class="comment-header">
                    <?= $comment->created_by == object('user')->id ? translate('You') : $comment->created_by_name ?>&nbsp;<?= translate('wrote') ?>
                    <time datetime="<?= $comment->created_on ?>" pubdate><?= helper('date.humanize', array('date' => $comment->created_on)) ?></time>
                </div>
                <p><?= escape($comment->text) ?></p>
            </div>
        <? endforeach ?>

    </div>
</div>
<script data-inline>
    jQuery( document ).ready(function($) {
        new Fora.Subscribe({
            holder: 'fora-topic-default',
            url: '<?= html_entity_decode(route('view=subscription&type=topic&row='.$topic->id.'&user_id='.object('user')->getId())) ?>',
            data: {
                action: '<?= $subscription ? 'delete' : 'add' ?>',
                type: 'topic',
                row: '<?= $topic->id ?>',
                user_id: '<?= object('user')->getId() ?>',
                _token: '<?= object('user')->getSession()->getToken() ?>',
                site: '<?=object('application')->getSite();?>'
            }
        });
    });
</script>

