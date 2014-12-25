<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<ul class="wanted-list clearfix">
    <? foreach ($articles as $article) : ?>
        <li class="wanted-list__item">
            <a href="<?= helper('route.article', array('row' => $article)) ?>">
                <? if($article->attachments_attachment_id): ?>
                    <?= helper('com:police.image.thumbnail', array(
                        'attachment' => $article->attachments_attachment_id,
                        'attribs' => array('width' => '400', 'height' => '300'))) ?>
                <? endif; ?>
                <span class="wanted-list__metadata">
                <span class="wanted-list__name"><?= escape($article->title) ?></span>
                <br />
                    <?= date(array('date' => $article->date, 'format' => 'd/m/y')) ?> <?= $article->city ? translate('in').' '.escape($article->city) : '' ?>
            </span>
            </a>
        </li>
    <? endforeach; ?>
</ul>