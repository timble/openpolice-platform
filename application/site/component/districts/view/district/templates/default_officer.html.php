<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<meta content="noimageindex" name="robots" />

<div class="card card--horizontal">
    <div class="card__box">
        <? if($officer->isAttachable()) : ?>
            <div class="card__image">
            <? if(count($officer->getAttachments())) : ?>
                <? $item = $officer->getAttachments()->top() ?>
                <? if($item->file->isImage()) : ?>
                    <img src="attachments://<?= $item->path ?>" />
                <? endif ?>
            <? elseif(!($officer->phone || $officer->mobile || $officer->email || $district->email)) : ?>
                <img src="assets://districts/images/placeholder.png" />
            <? endif ?>
            </div>
        <? endif ?>
        <div class="card__metadata">
            <div class="card__name">
                <?= $officer->title ?>
            </div>
            <div class="card__date">
                <? if($officer->phone || $officer->mobile || $officer->email || $district->email) : ?>
                <ul>
                    <? if($officer->phone) : ?><li><?= translate('Phone') ?>: <?= $officer->phone ?></li><? endif ?>
                    <? if($officer->mobile) : ?><li><?= translate('Mobile') ?>: <?= $officer->mobile ?></li><? endif ?>
                    <? if($officer->email || $district->email) : ?><li><?= translate('Email') ?>: <a href="mailto:<?= $officer->email ? $officer->email : $district->email ?>"><?= $officer->email ? $officer->email : $district->email ?></a></li><? endif ?>
                </ul>
                <? endif ?>
            </div>
        </div>
    </div>
</div>
