<?
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? foreach ($articles as $article) : ?>
    <article class="article">
        <? $link = helper('route.article', array('row' => $article)); ?>
        <header class="article__header">
            <h1><a href="<?= $link ?>"><?= $article->title ?></a></h1>
            <div class="text--small">
                <?= helper('date.format', array('date'=> $article->ordering_date, 'format' => translate('DATE_FORMAT_LC5'), 'attribs' => array('class' => 'published'))) ?>
            </div>
        </header>

        <? if($article->attachments_attachment_id): ?>
            <a class="article__thumbnail" tabindex="-1" href="<?= $link ?>">
                <?= helper('com:attachments.image.thumbnail', array(
                    'attachment' => $article->attachments_attachment_id,
                    'attribs' => array('width' => '400', 'height' => '300'))) ?>
            </a>
        <? endif; ?>

        <?= $article->introtext ?>

        <? if ($article->fulltext) : ?>
            <a href="<?= $link ?>"><?= translate('Read more') ?></a>
        <? endif; ?>
    </article>
<? endforeach; ?>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
