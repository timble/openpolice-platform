<?
/**
 * Belgian Police Web Platform - Press Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<ktml:module position="left">
    <? $modules = object('com:pages.model.modules')->position('quicklinks')->published('true')->getRowset(); ?>

    <? foreach($modules as $module) : ?>
        <div class="sidebar__element">
            <h3><?= $module->title ?></h3>
            <?= $module->content ?>
        </div>
    <? endforeach ?>
</ktml:module>

<title content="replace"><?= escape($article->title) ?></title>

<article class="article" itemscope itemtype="http://schema.org/Article">
    <header class="article__header">
        <time class="text--small" itemprop="datePublished" datetime="<?= $published_on ?>">
            <?= helper('date.format', array('date'=> $article->published_on, 'format' => translate('DATE_FORMAT_LC5'), 'attribs' => array('class' => 'published'))) ?>
        </time>
        <h1 itemprop="name"><?= escape($article->title) ?></h1>
    </header>

    <div itemprop="articleBody">
        <?= $article->text ?>
        <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array('0'))) ?>
    </div>
</article>

<? if(object('application')->getCfg('site') == 'fed') : ?>
    <?= import('com:press.view.articles.default_contact.html') ?>
<? endif; ?>
