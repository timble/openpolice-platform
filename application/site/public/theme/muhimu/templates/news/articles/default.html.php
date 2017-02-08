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
    <? $link = helper('route.article', array('row' => $article)); ?>
    <article class="media">
        <div class="media__image">
            <a class="media__image__inner" data-content="Lees meer" href="<?= $link ?>">
                <?= helper('com:attachments.image.thumbnail', array(
                    'attachment' => $article->attachments_attachment_id,
                    'attribs' => array('width' => '560', 'height' => '420'))) ?>
            </a>
        </div>
        <div class="media__content">
            <header>
                <span class="text--muted text--small">
                    <?= helper('date.format', array('date'=> $article->ordering_date, 'format' => translate('DATE_FORMAT_LC3'), 'attribs' => array('class' => 'published'))) ?>
                </span>
                <h1 class="media__title"><a href="<?= $link ?>"><?= $article->title ?></a></h1>
            </header>

            <?= $article->introtext ?>

            <? if ($article->fulltext) : ?>
                <a href="<?= $link ?>"><?= translate('Read more') ?></a>
            <? endif; ?>
        </div>
    </article>
<? endforeach; ?>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
