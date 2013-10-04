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
    <div class="media<?= !$article->attachments_attachment_id ? ' media--imageless' : ''; ?>">
        <? if($article->attachments_attachment_id): ?>
            <a tabindex="-1" class="pull-left thumbnail media-object" href="<?= '/'.$site.'/nieuws/'.$article->id.'-'.$article->slug ?>">
                <?= helper('com:attachments.image.thumbnail', array(
                    'attachment' => $article->attachments_attachment_id,
                    'attribs' => array('width' => '64px'))) ?>
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
