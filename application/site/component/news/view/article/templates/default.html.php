<?
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? if($article->attachments_attachment_id) : ?>
<meta property="og:image" content="http://<?= $url ?>attachments://<?= $thumbnail ?>" />
<? endif ?>

<ktml:module position="left">
    <? $modules = object('com:pages.model.modules')->position('quicklinks')->getRowset(); ?>

    <? foreach($modules as $module) : ?>
        <div class="sidebar__element">
            <h3><?= $module->title ?></h3>
            <?= $module->content ?>
        </div>
    <? endforeach ?>
</ktml:module>

<title content="replace"><?= $article->title ?></title>

<article class="article hentry">
    <header class="article__header">
        <h1 class="entry-title"><?= $article->title ?></h1>
        <span class="timestamp">
            <?= helper('date.format', array('date'=> $article->ordering_date, 'format' => translate('DATE_FORMAT_LC5'), 'attribs' => array('class' => 'published'))) ?>
        </span>
    </header>

    <? if($article->attachments_attachment_id) : ?>
    <figure class="article__thumbnail">
    <?= helper('com:attachments.image.thumbnail', array(
        'attachment' => $article->attachments_attachment_id,
        'attribs' => array('width' => '200', 'height' => '150'))) ?>
    </figure>
    <? endif ?>

    <div class="entry-summary"><?= $article->introtext ?></div>
    <div class="entry-content"><?= $article->fulltext ?></div>

    <div class="entry-content-asset">
        <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($article->attachments_attachment_id))) ?>
    </div>
</article>
