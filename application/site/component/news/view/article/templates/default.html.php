<?
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<meta content="http://<?= $url ?>attachments://<?= $thumbnail ?>" property="og:image" />

<ktml:module position="left">
    <? $modules = object('com:pages.model.modules')->position('quicklinks')->getRowset(); ?>

    <? foreach($modules as $module) : ?>
        <div class="sidebar__element">
            <h3><?= $module->title ?></h3>
            <?= $module->content ?>
        </div>
    <? endforeach ?>
</ktml:module>

<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher:'91c73e48-a5e0-43ea-988f-57d099f878c7'});</script>

<title content="replace"><?= $article->title ?></title>

<article class="article hentry">
    <header class="article__header">
        <h1 class="entry-title"><?= $article->title ?></h1>
        <span class="timestamp">
            <?= helper('date.format', array('date'=> $article->ordering_date, 'format' => translate('DATE_FORMAT_LC5'), 'attribs' => array('class' => 'published'))) ?>
        </span>
        <span style="float:right" class='st_sharethis' displayText='ShareThis'></span>
    </header>

    <? if($article->attachments_attachment_id) : ?>
    <figure class="article__thumbnail">
    <?= helper('com:attachments.image.thumbnail', array(
        'attachment' => $article->attachments_attachment_id,
        'attribs' => array('width' => '200', 'height' => '150', 'align' => 'right'))) ?>
    </figure>
    <? endif ?>

    <div class="entry-summary"><?= $article->introtext ?></div>
    <div class="entry-content"><?= $article->fulltext ?></div>

    <div class="entry-content-asset">
        <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array($article->attachments_attachment_id))) ?>
    </div>
</article>
