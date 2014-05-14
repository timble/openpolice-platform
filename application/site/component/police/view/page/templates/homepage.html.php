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
        <? $articles = object('com:news.controller.article')->sticky(true)->browse()->count() ? object('com:news.controller.article')->sticky(true)->limit('1')->browse() : object('com:news.controller.article')->limit('1')->browse(); ?>
        <? foreach ($articles as $article) : ?>
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
        <? endforeach; ?>
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
                    <span class="text--strong">101</span> <?= @translate('or') ?> <span class="text--strong"><?= $zone->phone_emergency ?></span>
                </p>
                <? if($zone->phone_information) : ?>
                <p>
                    <span class="muted"><?= translate('General information') ?></span><br />
                    <span class="text--strong"><?= $zone->phone_information ?></span>
                </p>
                <? endif ?>
            </div>

            <ul class="nav nav--list">
                <? if($site != '5888') : ?>
                <li><a href="/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Your district officer')) ?>"><?= translate('Your district officer') ?></a></li>
                <? endif ?>
                <li><a href="/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Stations')) ?>"><?= translate('Stations') ?></a></li>
                <? if($site != '5888') : ?>
                <li><a href="/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Services')) ?>"><?= translate('Services') ?></a></li>
                <? endif ?>
                <li><a href="/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Emergency numbers')) ?>"><?= translate('Emergency numbers') ?></a></li>
            </ul>
        </div>
    </div>
</div>