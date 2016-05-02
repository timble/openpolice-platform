<?
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? $email_to = str_replace("@", "&#64;", $district->coordinator_email) ?>
<? $email_to = str_replace(".", "&#46;", $email_to) ?>

<h3><?= $district->coordinator_firstname .' '.$district->coordinator_lastname ?></h3>

<address class="vcard">
    <div class="adr">
        <? if ($district->coordinator_address) : ?>
            <div class="street-address"><?= $district->coordinator_address ?></div>
        <? endif; ?>
        <?if ($district->coordinator_postcode) : ?>
            <span class="postal-code"><?= $district->coordinator_postcode?></span>
        <? endif; ?>
        <? if ( $district->coordinator_suburb) : ?>
            <span class="locality"><?= $district->coordinator_suburb?></span>
        <? endif; ?>
    </div>
    <ul>
        <? if ($district->coordinator_phone) :?>
            <li class="tel">
                <span class="type"><?= translate('Phone') ?></span>:
                <span class="value"><?= $district->coordinator_phone?></span>
            </li>
        <? endif; ?>
        <?if ($district->coordinator_mobile) :?>
            <li class="tel">
                <span class="type"><?= translate('Mobile') ?></span>:
                <span class="value"><?= $district->coordinator_mobile ?></span>
            </li>
        <? endif; ?>
        <?if ($district->coordinator_email) :?>
            <li>
                <span><?= translate('Email') ?></span>:
                <a class="email" href="mailto:<?= $email_to?>"><?= $email_to?></a>
            </li>
        <? endif; ?>
        <? if($district->facebook) : ?><li><a href="http://www.facebook.com/<?= $district->facebook ?>">www.facebook.com/<?= $district->facebook ?></a></li><? endif ?>
        <? if($district->twitter) : ?><li><a href="http://www.twitter.com/<?= $district->twitter ?>">www.twitter.com/<?= $district->twitter ?></a></li><? endif ?>
    </ul>
</address>
