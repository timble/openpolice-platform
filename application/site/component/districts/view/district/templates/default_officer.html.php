<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<? $params = $officer->params ?>

<h2 class="article__header"><?= $officer->title ?></h2>

<div class="clearfix">
    <? if($officer->attachments_attachment_id) : ?>
    <img class="thumbnail" src="attachments/<?= $officer->attachment_path ?>">
    <? else : ?>
    <img class="thumbnail" src="assets://districts/images/placeholder.png" />
    <? endif ?>
    <ul>
        <? if($officer->phone) : ?><li><?= translate('Phone') ?>: <?= $officer->phone ?></li><? endif ?>
        <? if($officer->mobile) : ?><li><?= translate('Mobile') ?>: <?= $officer->mobile ?></li><? endif ?>
        <? if($officer->email) : ?><li><?= translate('Email') ?>: <a href="mailto:<?= $officer->email ?>"><?= $officer->email ?></a></li><? endif ?>
    </ul>
</div>