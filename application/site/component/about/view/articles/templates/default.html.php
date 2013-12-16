<?
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? if(count($articles) > '1') : ?>
<ktml:module position="left">
    <?= import('com:categories.view.categories.list.html') ?>
</ktml:module>
<? endif ?>

<? foreach ($articles as $article) : ?>
    <? if(count($articles) == '1') : ?>
        <?= import('com:about.view.article.default.html', array('article' => $article)) ?>
    <? else : ?>

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
            <? if($article->fulltext) : ?>
                <a class="article__thumbnail" tabindex="-1" href="<?= $link ?>">
                    <?= helper('com:attachments.image.thumbnail', array(
                        'attachment' => $article->attachments_attachment_id,
                        'attribs' => array('width' => '200', 'height' => '150'))) ?>
                </a>
            <? else : ?>
                <?= helper('com:attachments.image.thumbnail', array(
                    'attachment' => $article->attachments_attachment_id,
                    'attribs' => array('class' => 'article__thumbnail', 'width' => '200', 'height' => '150'))) ?>
            <? endif; ?>

        <? endif; ?>

        <?= $article->introtext ?>

        <? if ($article->fulltext) : ?>
            <a href="<?= $link ?>"><?= translate('Read more') ?></a>
        <? endif; ?>
    </article>
    <? endif ?>
 <? endforeach; ?>
