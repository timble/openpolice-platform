<?
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<meta content="summary" name="twitter:card" />
<meta content="@<?= $zone->twitter ?>" name="twitter:site" />
<meta content="<?= url(); ?>" property="og:url" />
<meta content="<?= $article->title ?>" property="og:title" />
<meta content="<?= trim(preg_replace('/\s+/', ' ', strip_tags($article->introtext))) ?>" property="og:description" />
<? if($article->attachments_attachment_id) : ?>
<meta content="http://<?= $url ?>attachments://<?= $thumbnail ?>" property="og:image" />
<? endif ?>

<meta content="<?= $published_on ?>" property="article:published_time" />

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

<article class="article" itemscope itemtype="http://schema.org/Article">
    <header class="article__header">
        <h1 itemprop="name"><?= $article->title ?></h1>
        <time class="timestamp" itemprop="datePublished" datetime="2014-01-29T12:48">
            <?= helper('date.format', array('date'=> $article->ordering_date, 'format' => translate('DATE_FORMAT_LC5'), 'attribs' => array('class' => 'published'))) ?>
        </time>
    </header>

    <? if($article->attachments_attachment_id) : ?>
    <figure class="article__thumbnail">
    <?= helper('com:attachments.image.thumbnail', array(
        'attachment' => $article->attachments_attachment_id,
        'attribs' => array('width' => '200', 'height' => '150', 'itemprop'=> "image"))) ?>
    </figure>
    <? endif ?>

    <div itemprop="articleBody">
        <?= $article->introtext ?>
        <?= $article->fulltext ?>
        <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($article->attachments_attachment_id))) ?>
    </div>
</article>
