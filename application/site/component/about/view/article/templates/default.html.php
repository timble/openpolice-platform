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

<article <?= !$article->published ? 'class="article-unpublished"' : '' ?>>
    <h1><?= $article->title ?></h1>

    <?= helper('com:attachments.image.thumbnail', array('row' => $article)) ?>

    <? if($article->fulltext) : ?>
        <div class="article__introtext">
            <?= $article->introtext ?>
        </div>
    <? else : ?>
        <?= $article->introtext ?>
    <? endif ?>

    <?= $article->fulltext ?>

    <? // import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($article->attachments_attachment_id))) ?>
</article>