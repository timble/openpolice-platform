<script src="media://lib_koowa/js/koowa.js" />
<script src="media://com_fora/js/subscribe.js" />
<style src="assets://fora/css/default.css" />

<script>
    window.addEvent('domready', function() {

        SyntaxHighlighter.autoloader(
            'bash shell             media://com_fora/syntaxhighlighter/js/shBrushBash.js',
            'css                    media://com_fora/syntaxhighlighter/js/shBrushCss.js',
            'js jscript javascript  media://com_fora/syntaxhighlighter/js/shBrushJScript.js',
            'php                    media://com_fora/syntaxhighlighter/js/shBrushPhp.js',
            'text plain             media://com_fora/syntaxhighlighter/js/shBrushPlain.js',
            'sql                    media://com_fora/syntaxhighlighter/js/shBrushSql.js',
            'xml xhtml xslt html    media://com_fora/syntaxhighlighter/js/shBrushXml.js'
        );

        SyntaxHighlighter.defaults['class-name'] = 'highlight';
        SyntaxHighlighter.all();

        <? if($topic->discussible): ?>
        new Fora.Subscribe({
            holder: 'fora-topic-default',
            url: '<?= html_entity_decode(route('view=subscription&type=topic&row='.$topic->id.'&user_id='.JFactory::getUser()->id)) ?>',
            data: {
                action: '<?= $subscribed ? 'delete' : 'add' ?>',
                type: 'topic',
                row: '<?= $topic->id ?>',
                user_id: '<?= $this->getUser()->getId() ?>',
                _token: '<?= JUtility::getToken() ?>'
            }
        });
        <? endif; ?>
    });
</script>

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
                <? if($topic->discussible) : ?>
                    <button type="button" class="btn btn-small subscribe <?= $subscribed ? 'btn-subscribed' : 'btn-unsubscribed' ?>" title="Click to manage your subscription">
                        <i class="icon-star"></i>
                    </button>
                <? endif ?>
            </div>
        </div>
        <div class="well__content">
            <?= $topic->text ?>
            <hr />
            <div class="row-fluid">
                <div class="muted pull-right" style="line-height: 46px;">
                    <?//= import('default_vote'); ?>
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

