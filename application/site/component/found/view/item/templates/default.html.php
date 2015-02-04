<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<title content="replace"><?= escape($item->title) ?></title>

<div class="article">
    <h1><?= escape($item->title) ?></h1>
    <? if($item->attachments_attachment_id) : ?>
        <a onClick="ga('send', 'event', 'Attachments', 'Modalbox', 'Image');" class="article__thumbnail" href="attachments://<?= $item->thumbnail ?>" data-gallery="enabled">
            <?= helper('com:police.image.thumbnail', array(
                'attachment' => $item->attachments_attachment_id,
                'attribs' => array('width' => '400', 'height' => '300'))) ?>
        </a>
    <? endif ?>

    <ul>
        <li><?= translate('Date').': '.date(array('date' => $item->found_on, 'format' => 'd/m/y')) ?></li>
        <li><?= translate('Find place') ?>: <?= $item->street ? $item->street : translate('Unknown') ?></li>
        <li><?= translate('Tracking number').': '.$item->tracking_number ?></li>
    </ul>

    <?= $item->text ?>

    <? if($item->isAttachable()) : ?>
        <div class="entry-content-asset">
            <?= import('com:attachments.view.attachments.default.html', array('attachments' => $item->getAttachments(), 'exclude' => array($item->attachments_attachment_id))) ?>
        </div>
    <? endif ?>
</div>

<? if($item->attachments_attachment_id) : ?>
<script src="assets://application/components/jquery/dist/jquery.min.js" />
<script src="assets://application/components/magnific-popup/dist/jquery.magnific-popup.min.js" />
<script data-inline>
    $(document).ready(function() {
        // This will create a single gallery from all elements that have class data-gallery="enabled"
        $('[data-gallery="enabled"]').magnificPopup({
            type: 'image',
            gallery:{
                enabled:true
            }
        });
    });
</script>
<? endif ?>