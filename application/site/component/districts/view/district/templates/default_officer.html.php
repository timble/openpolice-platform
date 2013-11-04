<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<h2 class="article__header"><?= $officer->title ?></h2>

<? if($officer->phone || $officer->mobile || $officer->email) : ?>
<ul>
    <? if($officer->phone) : ?><li><?= translate('Phone') ?>: <?= $officer->phone ?></li><? endif ?>
    <? if($officer->mobile) : ?><li><?= translate('Mobile') ?>: <?= $officer->mobile ?></li><? endif ?>
    <? if($officer->email) : ?><li><?= translate('Email') ?>: <a href="mailto:<?= $officer->email ?>"><?= $officer->email ?></a></li><? endif ?>
</ul>
<? endif ?>

<? if($officer->attachments_attachment_id) : ?>
<img width="140px" class="thumbnail" src="attachments/<?= $officer->attachment_path ?>">
<? else : ?>
<img width="140px" class="thumbnail" src="assets://districts/images/placeholder.png" />
<? endif ?>