<?
/**
 * Belgian Police Web Platform - Theme
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? foreach($articles as $article) : ?>
    <? $link = '/'.object('lib:filter.slug')->sanitize(translate('News')).'/'.$article->id.'-'.$article->slug ?>
    <section class="media">
        <div class="media__image">
            <a class="media__image__inner" data-content="<?= translate('Read more') ?>" href="<?= $link ?>">
                <? if($article->attachments_attachment_id) : ?>
                <?= helper('com:police.image.picture', array(
                        'attachment' => $article->attachments_attachment_id,
                        'srcset' => array(110, 200, 400),
                        'sizes' => array('1024px' => '110px', '600px' => '15vw', '0' => '30vw'),
                        'ratio' => '4/3',
                        'attribs' => array())) ?>
                <? endif ?>
            </a>
        </div>
        <div class="media__content">
            <span class="text--muted text--small">
                <?= helper('date.format', array('date'=> $article->published_on, 'format' => translate('DATE_FORMAT_LC3'), 'attribs' => array('class' => 'published'))) ?>
            </span>
            <h1 class="media__title"><a href="<?= $link ?>"><?= $article->title ?></a></h1>
        </div>
    </section>
<? endforeach ?>
