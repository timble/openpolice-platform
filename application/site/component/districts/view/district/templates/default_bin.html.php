<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? if ($bin->facebook || $bin->twitter) : ?>
<ul>
<? if($bin->facebook) : ?><li><a href="http://www.facebook.com/<?= $bin->facebook ?>">www.facebook.com/<?= $bin->facebook ?></a></li><? endif ?>
<? if($bin->twitter) : ?><li><a href="http://www.twitter.com/<?= $bin->twitter ?>">www.twitter.com/<?= $bin->twitter ?></a></li><? endif ?>
</ul>
<? endif; ?>

<h3><?= $bin->coordinator_firstname .' '.$bin->coordinator_lastname ?></h3>

<address class="vcard">
    <div class="adr">
        <? if ($bin->coordinator_address) : ?>
            <div class="street-address"><?= $bin->coordinator_address ?></div>
        <? endif; ?>
        <?if ($bin->coordinator_postcode) : ?>
            <span class="postal-code"><?= $bin->coordinator_postcode ?></span>
        <? endif; ?>
        <? if ( $bin->coordinator_suburb) : ?>
            <span class="locality"><?= $bin->coordinator_suburb ?></span>
        <? endif; ?>
    </div>
    <? if ($bin->coordinator_phone || $bin->coordinator_mobile || $bin->coordinator_email) : ?>
    <ul>
        <? if ($bin->coordinator_phone) : ?>
            <li class="tel">
                <span class="type"><?= translate('Phone') ?></span>:
                <span class="value"><?= $bin->coordinator_phone ?></span>
            </li>
        <? endif; ?>
        <?if ($bin->coordinator_mobile) : ?>
            <li class="tel">
                <span class="type"><?= translate('Mobile') ?></span>:
                <span class="value"><?= $bin->coordinator_mobile ?></span>
            </li>
        <? endif; ?>
        <?if ($bin->coordinator_email) : ?>
            <? $email_to = str_replace("@", "&#64;", $bin->coordinator_email) ?>
            <? $email_to = str_replace(".", "&#46;", $email_to) ?>
            <li>
                <span><?= translate('Email') ?></span>:
                <a class="email" href="mailto:<?= $email_to ?>"><?= $email_to ?></a>
            </li>
        <? endif; ?>
    </ul>
    <? endif; ?>
</address>
