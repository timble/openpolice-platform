<title content="replace"><?= $article->title ?></title>

<article class="article">
    <? if (object('component')->getController()->canEdit()) : ?>
        <div class="btn-toolbar">
            <ktml:toolbar type="actionbar">
        </div>
    <? endif; ?>
    <h1 class="article__header"><?= $article->title ?></h1>

    <img class="article__thumbnail" align="right" src="<?= $article->thumbnail ?>" />

    <? if($article->fulltext) : ?>
        <div class="entry-summary">
            <?= $article->introtext ?>
        </div>
    <? else : ?>
        <?= $article->introtext ?>
    <? endif ?>

    <?= $article->fulltext ?>

    <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($article->attachments_attachment_id))) ?>
</article>