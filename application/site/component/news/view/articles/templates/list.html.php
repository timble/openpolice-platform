<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<? $site = object('application')->getCfg('site') ?>



<? foreach ($articles as $article) : ?>
    <div class="media<?= !$article->thumbnail ? ' media--imageless' : ''; ?>">
        <? if($article->thumbnail): ?>
            <a class="pull-left" href="<?= '/'.$site.'/nieuws/'.$article->id.'-'.$article->slug ?>">
                <?= helper('com:attachments.image.thumbnail', array('row' => $article, 'class' => 'media-object thumbnail')) ?>
            </a>
        <? endif; ?>
        <div class="media-body">
            <a class="media-heading" href="<?= '/'.$site.'/nieuws/'.$article->id.'-'.$article->slug ?>"><?= $article->title ?></a>

            <div class="muted" style="font-size: 0.85em">
                <?= helper('date.format', array('date'=> $article->ordering_date, 'format' => translate('DATE_FORMAT_LC5'))) ?>
            </div>
        </div>
    </div>
<? endforeach; ?>
