<?
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? $site = object('application')->getCfg('site') ?>

<? foreach ($articles as $article) : ?>
    <div class="media<?= !$article->thumbnail ? ' media--imageless' : ''; ?>">
        <? if($article->thumbnail): ?>
            <a tabindex="-1" class="pull-left thumbnail" href="<?= '/'.$site.'/nieuws/'.$article->id.'-'.$article->slug ?>">
                <img class="media-object" align="right" width="200" height="150" src="attachments://<?= $article->path; ?>" />
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
