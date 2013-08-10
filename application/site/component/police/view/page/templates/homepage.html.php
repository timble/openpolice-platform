<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>
<? $site = @object('application')->getCfg('site') ?>
<? $zone = @object('com:police.model.zone')->id($site)->getRow() ?>

<div class="row-fluid separator--below">
    <div class="span8 hidden-phone">
        <? foreach (@object('com:news.model.articles')->sticky(true)->getRowset() as $article) : ?>
            <div class="page-header">
                <h1><a href="<?= '/'.$site.'/nieuws/'.$article->id.'-'.$article->slug ?>"><?= $article->title ?></a></h1>
                <span class="timestamp">
                    <?= @helper('date.format', array('date'=> $article->ordering_date, 'format' => JText::_('DATE_FORMAT_LC5'))) ?>
                </span>
            </div>

            <div class="clearfix">
                <a href="<?= '/'.$site.'/nieuws/'.$article->id.'-'.$article->slug ?>">
                    <?= @helper('com:attachments.image.thumbnail', array('row' => $article)) ?>
                </a>

                <?= $article->introtext ?>

                <? if ($article->fulltext) : ?>
                    <a href="<?= '/'.$site.'/nieuws/'.$article->id.'-'.$article->slug ?>"><?= @text('Read more') ?></a>
                <? endif; ?>
            </div>
        <? endforeach; ?>
    </div>
    <div class="span4">
        <div class="box">
            <h3>Contacteer ons</h3>
            <div  class="well" style="padding: 8px 12px; margin-bottom: 12px">
                <div><span class="text--strong"><a href="tel:101">101</a></span> <span class="text--small">voor dringende politiehulp</span></div>
                <div><span class="text--strong"><a href="tel:<?= $zone->telephone ?>"><?= $zone->telephone ?></a></span> <span class="text--small">geen spoed</span></div>
            </div>

            <ul class="nav nav-tabs nav-stacked">
                <li><a href="/<?= $site ?>/contact/commissariaten">Commissariaten</a></li>
                <li><a href="/<?= $site ?>/contact/je-wijkinspecteur">Je wijkinspecteur</a></li>
                <li><a href="/<?= $site ?>/contact/diensten">Diensten</a></li>
                <li><a href="/<?= $site ?>/contact/noodnummers">Noodnummers</a></li>
            </ul>

        </div>
    </div>
</div>

<div class="row-fluid">
    <?= @template('homepage_shortcuts.html', array('class' => 'span3')) ?>
</div>