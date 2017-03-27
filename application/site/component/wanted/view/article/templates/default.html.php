<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<meta content="noimageindex" name="robots" />

<ktml:module position="left">
    <?= import('com:wanted.view.sections.list.html') ?>
    <? if($article->params->get('childfocus', false)) : ?>
    <div class="sidebar__element sidebar__element--childfocus">
        <p><?= translate('In cooperation with') ?><br />
            <a href="http://<?= translate('www.childfocus.be') ?>">
                <img src="assets://wanted/images/childfocus.jpg" />
            </a>
        </p>
    </div>
    <? endif ?>
</ktml:module>

<title content="replace"><?= escape($article->title) ?></title>

<article class="article">
    <h1><?= escape($article->title) ?></h1>

    <? if($article->solved) : ?>
    <div class="article__text">
        <img class="article__thumbnail" src="assets://wanted/images/solved.png" />

        <?= $article->text ?>
    </div>
    <? else : ?>
    <div class="article__text">
        <? if($article->attachments_attachment_id) : ?>
            <a onClick="ga('send', 'event', 'Attachments', 'Modalbox', 'Image');" class="article__thumbnail article__thumbnail--wanted" href="attachments://<?= $article->thumbnail ?>" data-gallery="enabled">
                <?= helper('com:police.image.thumbnail', array(
                    'attachment' => $article->attachments_attachment_id,
                    'attribs' => array('width' => '400', 'height' => '500'))) ?>
            </a>
        <? endif ?>

        <dl>
            <dt><?= translate('Date') ?>:</dt>
            <dd><?= date(array('date' => $article->date, 'format' => translate('DATE_FORMAT_LC4'))) ?></dd>
            <? if($article->city || $article->params->get('place', false)) : ?>
            <dt><?= translate('Place') ?>:</dt>
            <dd><?= $article->city ? $article->city : $article->params->get('place') ?></dd>
            <? endif ?>
        </dl>

        <?= $article->text ?>

        <? if($article->params->get('requestor', false)) : ?>
        <p class="text--small">
            <?= sprintf(translate('Spread on %s at the request of %s'), date(array('date' => $article->published_on, 'format' => 'd/m/Y')), $article->params->get('requestor')) ?>.
        </p>
        <? endif ?>
    </div>

    <? if($article->isAttachable()) : ?>
    <div class="entry-content-asset">
        <?= import('com:attachments.view.attachments.default.html', array('attachments' => $article->getAttachments(), 'exclude' => array($article->attachments_attachment_id))) ?>
    </div>
    <? endif ?>

    <div style="margin-bottom: 30px">
        <?= import('com:news.view.article.default_youtube.html', array('youtube' => $article->params->get('youtube', false))) ?>
    </div>

    <div class="well">
        <h2><?= translate('Testimonials') ?></h2>
        <p><?= translate('Do you have more information') ?><?= $article->params->get('childfocus', false) ? ' '.translate('or with Child Focus') : '' ?>.</p>
        <p><?= str_replace('case_id', $article->case_id, translate('Contact us by email')) ?>.</p>
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