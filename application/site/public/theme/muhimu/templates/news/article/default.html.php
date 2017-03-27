<?
/**
 * Belgian Police Web Platform - Theme
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<meta content="<?= @translate('Police') ?> <?= $zone->title ?>" name="author" />
<? if($zone->twitter) : ?>
    <meta content="summary" name="twitter:card" />
    <meta content="@<?= $zone->twitter ?>" name="twitter:site" />
<? endif ?>
<meta content="<?= url(); ?>" property="og:url" />
<meta content="<?= $article->title ?>" property="og:title" />
<meta content="<?= trim(preg_replace('/\s+/', ' ', strip_tags($article->introtext))) ?>" property="og:description" />
<? if($article->attachments_attachment_id) : ?>
    <meta content="http://<?= $url ?>attachments://<?= $article->thumbnail ?>" property="og:image" />
<? endif ?>

<meta content="<?= $article->published_on_utc ?>" property="article:published_time" />

<title content="replace"><?= $article->title ?></title>

<article class="article" itemscope itemtype="http://schema.org/Article">
    <header class="article__header">
        <time class="text--small" itemprop="datePublished" datetime="<?= $article->published_on_utc ?>">
            <?= helper('date.format', array('date'=> $article->ordering_date, 'format' => translate('j F Y - H:i'), 'attribs' => array('class' => 'published'))) ?>
        </time>
        <h1 itemprop="name"><?= $article->title ?></h1>
    </header>

    <div itemprop="articleBody">
        <? if($article->attachments_attachment_id) : ?>
        <?= helper('com:police.image.picture', array(
                'attachment' => $article->attachments_attachment_id,
                'srcset' => array(200, 400),
                'sizes' => array('540px' => '200px', '400px' => '40vw'),
                'ratio' => '4/3',
                'attribs' => array('class' => 'article__thumbnail', 'itemprop' => "image"))) ?>
        <? endif ?>

        <div<?= $article->fulltext ? ' class="article__introtext"' : '' ?>>
            <?= $article->introtext ?>
        </div>
        <?= $article->fulltext ?>
        <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($article->attachments_attachment_id))) ?>
    </div>
</article>
