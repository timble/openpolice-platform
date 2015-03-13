<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<ul class="cards clearfix">
    <? foreach ($articles as $article) : ?>
        <li class="card">
            <a href="<?= helper('route.article', array('row' => $article)) ?>">
                <? if($article->attachments_attachment_id): ?>
                    <?= helper('com:police.image.thumbnail', array(
                        'attachment' => $article->attachments_attachment_id,
                        'attribs' => array('width' => '400', 'height' => '300'))) ?>
                <? else : ?>
                    <img src="assets://found/images/placeholder.jpg" />
                <? endif ?>

                <span class="card__metadata">
                    <span class="card__metadata--inner">
                        <span class="card__name"><?= escape($article->title) ?></span>
                        <span class="card__date"><?= date(array('date' => $article->date, 'format' => 'd/m/y')) ?> <?= $article->city ? translate('in').' '.escape($article->city) : '' ?></span>
                        <? if($article->params->get('place', false) || $article->city) : ?>
                        <span class="card__place"><?= $article->city ? $article->city : $article->params->get('place') ?></span>
                        <? endif ?>
                    </span>
                </span>
            </a>
        </li>
    <? endforeach; ?>
</ul>
