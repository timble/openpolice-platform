<?
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<ktml:module position="left">
    <?= import('com:categories.view.categories.list.html') ?>
</ktml:module>

<title content="replace"><?= $article->title ?></title>

<article class="article">
    <h1><?= $article->title ?></h1>
    <? if($article->attachments_attachment_id) : ?>
        <a onClick="ga('send', 'event', 'Attachments', 'Modalbox', 'Image');" class="article__thumbnail" href="attachments://<?= $article->thumbnail ?>" data-gallery="enabled">
            <?= helper('com:attachments.image.thumbnail', array(
                'attachment' => $article->attachments_attachment_id,
                'attribs' => array('width' => '400', 'height' => '300'))) ?>
        </a>
    <? endif ?>

    <? if($article->fulltext) : ?>
        <div class="article__introtext">
            <?= $article->introtext ?>
        </div>
    <? else : ?>
        <?= $article->introtext ?>
    <? endif ?>

    <?= $article->fulltext ?>

    <? if($article->isAttachable()) : ?>
    <div class="entry-content-asset">
        <?= import('com:attachments.view.attachments.default.html', array('attachments' => $article->getAttachments(), 'exclude' => array($article->attachments_attachment_id))) ?>
    </div>
    <? endif ?>
</article>