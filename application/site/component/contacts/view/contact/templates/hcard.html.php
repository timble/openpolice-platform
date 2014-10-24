<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<? $email_to = str_replace("@", "&#64;", $contact->email_to) ?>
<? $email_to = str_replace(".", "&#46;", $email_to) ?>

<address itemscope itemtype="<?= $category->id == '1' ? 'http://schema.org/PoliceStation' : 'http://schema.org/CivicStructure' ?>">
    <h1 class="article__header" itemprop="name"><?= $contact->title?></h1>
    <? if($contact->name) : ?>
    <h2><?= $contact->name?></h2>
    <? endif ?>
    <? if($contact->isAttachable()) : ?>
        <? foreach($contact->getAttachments() as $item) : ?>
            <? if($item->file->isImage()) : ?>
                <img class="article__thumbnail" itemprop="photo" width="400" height="300"  align="right" src="attachments://<?= $item->thumbnail ?>" />
            <? endif ?>
        <? endforeach ?>
    <? endif ?>
    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
        <? if ($contact->street || $contact->number) : ?>
            <span itemprop="streetAddress"><?= $contact->street ?> <?= $contact->number?></span><br />
        <? endif; ?>
        <?if ($contact->postcode) : ?>
            <span itemprop="postalCode"><?= $contact->postcode?></span>
        <? endif; ?>
        <? if ($contact->city) : ?>
            <span itemprop="addressLocality"><?= $contact->city?></span>
        <? elseif ($contact->suburb) : ?>
            <span itemprop="addressLocality"><?= $contact->suburb ?></span><br />
        <? endif; ?>
    </div>
    <ul>
        <? if ($contact->telephone) :?>
            <li>
                <span><?= translate('Phone') ?></span>:
                <span itemprop="telephone"><?= $contact->telephone?></span>
            </li>
        <? endif; ?>
        <? if ($contact->fax) :?>
            <li>
                <span><?= translate('Fax') ?></span>:
                <span itemprop="faxNumber"><?= $contact->fax?></span>
            </li>
        <? endif; ?>
        <?if ($contact->mobile) :?>
            <li>
                <span><?= translate('Mobile') ?></span>:
                <span><?= $contact->mobile?></span>
            </li>
        <? endif; ?>
        <?if ($contact->email_to) :?>
            <li>
                <span><?= translate('Email') ?></span>:
                <a itemprop="email" href="mailto:<?= $email_to?>"><?= $email_to?></a>
            </li>
        <? endif; ?>
        <?if ($contact->url) :?>
            <li>
                <span><?= translate('Website') ?></span>:
                <a itemprop="sameAs" href="<?= $contact->url ?>"><?= str_replace('http://', '', $contact->url); ?></a>
            </li>
        <? endif; ?>
    </ul>

    <?if ($contact->misc) :?>
        <span itemprop="description">
            <?= $contact->misc ?>
        </span>
    <? endif; ?>

    <?= object('com:contacts.controller.hour')->contact($contact->id)->render(array('contact' => $contact)); ?>
</address>
