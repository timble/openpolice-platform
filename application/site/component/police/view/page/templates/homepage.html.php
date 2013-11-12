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

<div class="row-fluid">
    <div class="span4 contact">
        <div class="contact__inner">
            <h3 class="hidden-phone"><?= translate('Contact us') ?></h3>
            <div  class="well well--small">
                <div>
                    <span class="text--strong"><a tabindex="-1" href="tel:101">101</a></span>
                    <span class="text--small"><?= translate('Urgent police assistance') ?></span>
                </div>
                <div>
                    <span class="text--strong"><a tabindex="-1" href="tel:<?= str_replace(' ', '', $zone->phone_emergency) ?>"><?= $zone->phone_emergency ?></a></span>
                    <span class="text--small"><?= translate('no emergency') ?></span>
                </div>
                <? if($zone->phone_information) : ?>
                    <div>
                        <span class="text--strong"><a tabindex="-1" href="tel:<?= str_replace(' ', '', $zone->phone_information) ?>"><?= $zone->phone_information ?></a></span>
                        <span class="text--small"><?= translate('general information') ?></span>
                    </div>
                <? endif ?>
            </div>

            <ul class="nav nav-tabs nav-stacked visible-phone">
                <li><a href="/<?= $site ?>/<?= object('lib:filter.slug')->sanitize(translate('News')) ?>"><?= translate('News') ?></a></li>
                <li><a href="/<?= $site ?>/<?= object('lib:filter.slug')->sanitize(translate('Questions')) ?>"><?= translate('Frequently asked questions') ?></a></li>
                <li><a href="/<?= $site ?>/<?= object('lib:filter.slug')->sanitize(translate('Traffic')) ?>"><?= translate('Traffic information') ?></a></li>
                <li><a href="/<?= $site ?>/<?= object('lib:filter.slug')->sanitize(translate('About us')) ?>"><?= translate('About us') ?></a></li>
                <li><a href="/<?= $site ?>/<?= object('lib:filter.slug')->sanitize(translate('Contact')) ?>"><?= translate('Contacteer ons') ?></a></li>
            </ul>

            <ul class="nav nav-tabs nav-stacked hidden-phone">
                <li><a href="/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Your district officer')) ?>"><?= translate('Your district officer') ?></a></li>
                <li><a href="/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Stations')) ?>"><?= translate('Stations') ?></a></li>
                <li><a href="/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Services')) ?>"><?= translate('Services') ?></a></li>
                <li><a href="/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Emergency numbers')) ?>"><?= translate('Emergency numbers') ?></a></li>
            </ul>
        </div>
    </div>
    <div class="span8 sticky alpha">
        <? foreach (object('com:news.model.articles')->sticky(true)->getRowset() as $article) : ?>
            <? $link = '/'.$site.'/'.object('lib:filter.slug')->sanitize(translate('News')).'/'.$article->id.'-'.$article->slug ?>
            <article class="hidden-phone">
                <header class="article__header">
                    <h1><a href="<?= $link ?>"><?= $article->title ?></a></h1>
                    <span class="timestamp">
                        <?= helper('date.format', array('date'=> $article->ordering_date, 'format' => translate('DATE_FORMAT_LC5'))) ?>
                    </span>
                </header>

                <div class="clearfix">
                    <? if($article->attachments_attachment_id) : ?>
                    <a class="article__thumbnail" tabindex="-1" href="<?= $link ?>">
                        <figure>
                            <?= helper('com:attachments.image.thumbnail', array(
                                'attachment' => $article->attachments_attachment_id,
                                'attribs' => array('width' => '200', 'align' => 'right'))) ?>
                        </figure>
                    </a>
                    <? endif ?>

                    <?= $article->introtext ?>

                    <? if ($article->fulltext) : ?>
                        <a href="<?= $link ?>"><?= translate('Read more') ?></a>
                    <? endif; ?>
                </div>
            </article>
        <? endforeach; ?>
        <div class="visible-phone">
            <h3><?= translate('Latest news') ?></h3>
            <?= import('com:news.view.articles.list.html', array('articles' =>  object('com:news.model.articles')->sort('ordering_date')->direction('DESC')->published(true)->limit('3')->getRowset())) ?>
        </div>
    </div>
</div>

<ktml:modules position="quicklinks">
    <div class="container-quicklinks">
        <div class="row-fluid">
            <ktml:modules:content>
        </div>
    </div>
</ktml:modules>