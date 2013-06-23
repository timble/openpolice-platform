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

<div class="row">
    <div class="span8 hidden-phone">
        <? foreach (@object('com:news.model.articles')->sticky(true)->getRowset() as $article) : ?>
            <div class="page-header">
                <h1><a href="<?= $site.'/nieuws/'.$article->id.'-'.$article->slug ?>"><?= $article->title ?></a></h1>
                <span class="timestamp">
                    <?= @helper('date.format', array('date'=> $article->ordering_date, 'format' => JText::_('DATE_FORMAT_LC5'))) ?>
                </span>
            </div>

            <div class="clearfix">
                <? if($article->thumbnail): ?>
                    <img class="thumbnail" src="<?= $article->thumbnail ?>" />
                <? endif; ?>

                <?= $article->introtext ?>

                <? if ($article->fulltext) : ?>
                    <a href="<?= $site.'/nieuws/'.$article->id.'-'.$article->slug ?>"><?= @text('Read more') ?></a>
                <? endif; ?>
            </div>
        <? endforeach; ?>
    </div>
    <div class="span4">
        <div class="box">
            <p><strong><i class="icon-phone"></i> 101</strong> voor dringende politiehulp</p>
            <p><strong><i class="icon-phone"></i> <?= $zone->telephone ?></strong> geen spoed</p>
            <hr />
            <h3><i class="icon-comments-alt"></i> Contacteer ons</h3>
            <ul class="nav">
                <li><a href="/<?= $site ?>/contact/commissariaten">Commissariaten</a></li>
                <li><a href="/<?= $site ?>/contact/je-wijkinspecteur">Je wijkinspecteur</a></li>
                <li><a href="/<?= $site ?>/contact/diensten">Diensten</a></li>
                <li><a href="/<?= $site ?>/contact/noodnummers">Noodnummers</a></li>
            </ul>
        </div>
    </div>
</div>
<hr />
<?= @template('homepage_shortcuts.html') ?>
