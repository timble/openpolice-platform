<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<ktml:module position="left">
    <?= import('com:wanted.view.sections.list.html') ?>
</ktml:module>

<title content="replace"><?= escape($article->title) ?></title>

<article class="article">
    <h1><?= escape($article->title) ?></h1>
    <? if($article->attachments_attachment_id) : ?>
        <a onClick="ga('send', 'event', 'Attachments', 'Modalbox', 'Image');" class="article__thumbnail" href="attachments://<?= $article->thumbnail ?>" data-gallery="enabled">
            <?= helper('com:police.image.thumbnail', array(
                'attachment' => $article->attachments_attachment_id,
                'attribs' => array('width' => '400', 'height' => '500'))) ?>
        </a>
    <? endif ?>

    <dl>
        <dt><?= translate('Date section'.$section->id) ?>:</dt>
        <dd><?= date(array('date' => $article->date, 'format' => 'd/m/y')) ?></dd>
        <? if($article->city || $article->params->get('place', false)) : ?>
        <dt><?= translate('Place section'.$section->id) ?>:</dt>
        <dd><?= $article->city ? $article->city : $article->params->get('place') ?></dd>
        <? endif ?>
    </dl>

    <?= $article->text ?>

    <?= import('com:news.view.article.default_youtube.html', array('youtube' => $article->params->get('youtube', false))) ?>

    <? if($article->isAttachable()) : ?>
    <div class="entry-content-asset">
        <?= import('com:attachments.view.attachments.default.html', array('attachments' => $article->getAttachments(), 'exclude' => array($article->attachments_attachment_id))) ?>
    </div>
    <? endif ?>
</article>

<script src="assets://application/components/jquery/dist/jquery.min.js" />
<script src="assets://application/components/magnific-popup/dist/jquery.magnific-popup.min.js" />
<script data-inline>
    $(document).ready(function() {
        // This will create a single gallery from all elements that have class data-gallery="enabled"
        $('[data-gallery="enabled"]').magnificPopup({
            type: 'image',
            gallery:{
                enabled:true
            }
        });
    });
</script>