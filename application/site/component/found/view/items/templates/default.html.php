<?
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<h1><?= escape($params->get('page_title')); ?></h1>
<ul class="cards clearfix">
    <? foreach ($items as $item) : ?>
        <li class="card">
            <a href="<?= helper('route.item', array('row' => $item)) ?>">
                <? if($item->attachments_attachment_id): ?>
                    <?= helper('com:police.image.thumbnail', array(
                        'attachment' => $item->attachments_attachment_id,
                        'attribs' => array('width' => '400', 'height' => '300', 'alt' => $item->title))) ?>
                <? else : ?>
                    <img src="assets://found/images/placeholder.jpg" />
                <? endif ?>
                <span class="card__metadata">
                    <span class="card__metadata--inner">
                        <span class="card__name"><?= escape($item->title) ?></span>
                        <span class="card__date"><?= date(array('date' => $item->found_on, 'format' => 'd/m/y')) ?></span>
                    </span>
                </span>
            </a>
        </li>
    <? endforeach; ?>
</ul>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
