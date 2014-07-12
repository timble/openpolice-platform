<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>
<? $site = object('application')->getCfg('site') ?>
<? $zone = object('com:police.model.zone')->id($site)->getRow() ?>

<div class="clearfix">
    <div class="homepage__sticky">
        <? $stickies = object('com:news.model.articles')->sticky(true)->getRowset();
            $article = $stickies->count() ? $stickies->top() : object('com:news.model.articles')->limit('1')->getRowset()->top(); ?>
        <? $link = '/'.$site.'/'.object('lib:filter.slug')->sanitize(translate('News')).'/'.$article->id.'-'.$article->slug ?>
        <article>
            <header class="article__header">
                <h1><a href="<?= $link ?>"><?= $article->title ?></a></h1>
                <span class="text--small">
                    <?= helper('date.format', array('date'=> $article->ordering_date, 'format' => translate('DATE_FORMAT_LC5'))) ?>
                </span>
            </header>

            <div class="clearfix">
                <? if($article->attachments_attachment_id) : ?>
                    <a class="article__thumbnail" tabindex="-1" href="<?= $link ?>">
                        <?= helper('com:attachments.image.thumbnail', array(
                            'attachment' => $article->attachments_attachment_id,
                            'attribs' => array('width' => '400', 'height' => '300'))) ?>
                    </a>
                <? endif ?>

                <?= $article->introtext ?>

                <? if ($article->fulltext) : ?>
                    <a href="<?= $link ?>"><?= translate('Read more') ?></a>
                <? endif; ?>
            </div>
        </article>
        <div class="homepage__news">
            <?= import('com:news.view.articles.list.html', array('articles' =>  object('com:news.model.articles')->sort('ordering_date')->direction('DESC')->published(true)->limit('2')->exclude($article->id)->getRowset())) ?>
        </div>
    </div>
    <div class="homepage__contact">
        <div class="contact__inner">
            <h3><?= translate('Contact us') ?></h3>
            <div class="well well--small">
                <p>
                    <span class="muted"><?= translate('Urgent police assistance') ?></span><br />
                    <span class="text--strong">101</span>
                    <? if($zone->phone_emergency) : ?>
                    <?= @translate('or') ?> <span class="text--strong"><?= $zone->phone_emergency ?></span>
                    <? endif ?>
                </p>
                <? if($zone->phone_information) : ?>
                <p>
                    <span class="muted"><?= translate('General information') ?></span><br />
                    <span class="text--strong"><?= $zone->phone_information ?></span>
                </p>
                <? endif ?>
            </div>

            <ul class="nav nav--list">
                <? foreach(object('com:pages.model.pages')->menu('1')->published('true')->hidden('false')->getRowset() as $page) : ?>
                    <? if($page->level == '2') : ?>
                    <li><a href="/<?= $site ?>/contact/<?= $page->slug ?>"><?= $page->title ?><?= $page->ancestor_id ?></a></li>
                    <? endif ?>
                <? endforeach ?>
            </ul>
        </div>
    </div>
</div>