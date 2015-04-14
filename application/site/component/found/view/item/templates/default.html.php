<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<title content="replace"><?= escape($item->title) ?> - <?= translate('Found items') ?></title>

<div class="article">
    <h1><?= escape($item->title) ?></h1>

    <dl>
        <dt><?= translate('Found on') ?>:</dt>
        <dd><?= date(array('date' => $item->found_on, 'format' => translate('DATE_FORMAT_LC4'))) ?></dd>
        <dt><?= translate('Find place') ?>:</dt>
        <dd><?= $item->street ? $item->street : translate('Unknown') ?></dd>
        <dt><?= translate('Tracking number') ?>:</dt>
        <dd><?= $item->tracking_number ?></dd>
        <dt><?= translate('Description') ?>:</dt>
        <dd><?= $item->text ?></dd>
    </dl>

    <?= import('com:attachments.view.attachments.default.html', array('attachments' => $attachments, 'exclude' => array(0))) ?>
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