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

<? foreach ($articles as $article) : ?>
<article class="article">
    <? $link = helper('route.article', array('row' => $article)); ?>
    <h1 class="article__header">
        <? if($article->fulltext) : ?>
        <a href="<?= $link ?>">
            <?= $article->title ?>
        </a>
        <? else : ?>
            <?= $article->title ?>
        <? endif; ?>
    </h1>

    <? if($article->attachments_attachment_id): ?>
        <a class="article__thumbnail" tabindex="-1" href="<?= $link ?>">
            <?= helper('com:attachments.image.thumbnail', array(
                'attachment' => $article->attachments_attachment_id,
                'attribs' => array('width' => '200', 'align' => 'right'))) ?>
        </a>
    <? endif; ?>

    <?= $article->introtext ?>

    <? if ($article->fulltext) : ?>
        <a href="<?= $link ?>"><?= translate('Read more') ?></a>
    <? endif; ?>
</article>
<? endforeach; ?>