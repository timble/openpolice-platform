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
            <a class="media__image__inner" data-content="<?= translate('Read more') ?>" href="<?= $link ?>">
                <? if($article->attachments_attachment_id) : ?>
                <?= helper('com:police.image.picture', array(
                        'attachment' => $article->attachments_attachment_id,
                        'srcset' => array(200, 400),
                        'sizes' => array('768px' => '15vw', '400px' => '30vw'),
                        'ratio' => '4/3',
                        'attribs' => array())) ?>
                <? endif ?>
            </a>
        </div>
        <div class="media__content">
            <header>
                <span class="text--muted text--small">
                    <?= helper('date.format', array('date'=> $article->ordering_date, 'format' => translate('DATE_FORMAT_LC3'), 'attribs' => array('class' => 'published'))) ?>
                </span>
                <h1 class="media__title"><a href="<?= $link ?>"><?= $article->title ?></a></h1>
            </header>

            <p>
                <?= $article->description ?>
            </p>
        </div>
    </article>
<? endforeach; ?>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
