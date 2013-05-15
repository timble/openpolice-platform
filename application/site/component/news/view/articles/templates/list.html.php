<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<? $site = @object('application')->getCfg('site') ?>

<ul class="media-list">
    <? foreach ($articles as $article) : ?>
    <li class="media">
        <? if($article->thumbnail): ?>
        <a class="pull-left" href="<?= $site.'/nieuws/'.$article->id.'-'.$article->slug ?>">
            <img class="media-object thumbnail" style="width: 64px" src="<?= $article->thumbnail ?>" />
        </a>
        <? endif; ?>
        <div class="media-body">
            <p class="media-heading" style="margin-bottom: 0"><a href="<?= $site.'/nieuws/'.$article->id.'-'.$article->slug ?>"><?= $article->title ?></a></p>
            <span class="muted" style="font-size: 0.85em">
                <?= @helper('date.format', array('date'=> $article->ordering_date, 'format' => JText::_('DATE_FORMAT_LC5'))) ?>
            </span>
        </div>
    </li>
    <? endforeach; ?>
</ul>
