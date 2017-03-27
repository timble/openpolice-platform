<?
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<title content="replace"><?= translate('Found items') ?></title>

<h1><?= translate('Found items') ?></h1>

<div class="well">
    <form class="search-box" action="" method="get">
        <div class="search-box__input">
            <input name="searchword" type="search" value="<?=escape($state->searchword)?>" placeholder="<?=translate('Search')?> ..." tabindex="1"/>
        </div>
        <button type="submit" class="button button--primary search-box__button" tabindex="2"><?= translate('Search') ?></button>
    </form>
</div>

<? if(count($items)) : ?>
    <ul class="cards clearfix">
        <? foreach ($items as $item) : ?>
            <li class="card">
                <a class="card__box" href="<?= helper('route.item', array('row' => $item)) ?>">
                    <div class="card__image">
                    <? if($item->attachments_attachment_id): ?>
                        <?= helper('com:police.image.thumbnail', array(
                            'attachment' => $item->attachments_attachment_id,
                            'attribs' => array('width' => '400', 'height' => '300', 'alt' => $item->title))) ?>
                    <? else : ?>
                        <img src="assets://found/images/placeholder.jpg" />
                    <? endif ?>
                    </div>
                    <div class="card__metadata">
                        <span class="card__name"><?= escape($item->title) ?></span>
                        <span class="card__date"><?= date(array('date' => $item->found_on, 'format' => translate('DATE_FORMAT_LC4'))) ?></span>
                    </div>
                </a>
            </li>
        <? endforeach; ?>
    </ul>
<? else : ?>
    <h2 id="no-results"><?= translate('No items found') ?>.</h2>
<? endif ?>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
