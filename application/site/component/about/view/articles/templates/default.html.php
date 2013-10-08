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
<div class="article">
    <h1 class="article__header">
        <? if($article->fulltext) : ?>
        <a href="<?= helper('route.article', array('row' => $article)) ?>">
            <?= $article->title ?>
        </a>
        <? else : ?>
            <?= $article->title ?>
        <? endif; ?>
    </h1>
    <?= $article->introtext ?>
    <? if($article->fulltext) : ?>
    <a class="article__readmore" href="<?= helper('route.article', array('row' => $article)) ?>">
        <?= translate('Read more') ?>
    </a>
    <? endif; ?>
</div>
<? endforeach; ?>