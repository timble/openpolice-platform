<title content="replace"><?= escape($article->title) ?></title>

<article class="article">
    <? if (object('component')->getController()->canEdit()) : ?>
        <div class="btn-toolbar">
            <ktml:toolbar type="actionbar">
        </div>
    <? endif; ?>
    <h1 class="article__header"><?= escape($article->title) ?></h1>

    <? if($article->thumbnail) : ?>
    <img class="article__thumbnail" align="right" src="<?= $article->thumbnail ?>" />
    <? endif ?>

    <? if($article->fulltext) : ?>
        <div class="article__introtext entry-summary">
            <?= $article->introtext ?>
        </div>
    <? else : ?>
        <?= $article->introtext ?>
    <? endif ?>

    <?= $article->fulltext ?>

    <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($article->attachments_attachment_id))) ?>
</article>