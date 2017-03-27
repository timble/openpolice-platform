<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? $email_to = str_replace("@", "&#64;", $contact->email_to) ?>
<? $email_to = str_replace(".", "&#46;", $email_to) ?>

<address>
    <h1 class="article__header"><?= $contact->title?></h1>
    <? if($contact->name && $category->id == '2') : ?>
    <h2><?= $contact->name?></h2>
    <? endif ?>
    <? if(isset($thumbnail)) : ?>
        <img class="article__thumbnail" width="400" height="300" align="right" src="attachments://<?= $thumbnail ?>" />
    <? endif ?>
    <p>
        <? if (isset($contact->street) || $contact->number) : ?>
            <span><?= $contact->street ?> <?= $contact->number ?></span><br />
        <? endif; ?>
        <?if (isset($contact->street) && $contact->postcode) : ?>
            <span><?= $contact->postcode ?></span>
        <? endif; ?>
        <? if (isset($contact->street)) : ?>
            <span><?= $contact->city ?></span>
        <? endif; ?>
    </p>
    <ul>
        <? if ($contact->telephone) :?>
            <li>
                <span><?= translate('Phone') ?></span>:
                <span><?= $contact->telephone?></span>
            </li>
        <? endif; ?>
        <? if ($contact->fax) :?>
            <li>
                <span><?= translate('Fax') ?></span>:
                <span><?= $contact->fax?></span>
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
                <a href="mailto:<?= $email_to?>"><?= $email_to?></a>
            </li>
        <? endif; ?>
        <?if ($contact->url) :?>
            <li>
                <span><?= translate('Website') ?></span>:
                <a href="<?= $contact->url ?>"><?= str_replace('http://', '', $contact->url); ?></a>
            </li>
        <? endif; ?>
    </ul>

    <?if ($contact->misc) :?>
        <span>
            <?= $contact->misc ?>
        </span>
    <? endif; ?>

    <?= object('com:contacts.controller.hour')->contact($contact->id)->render(array('contact' => $contact)); ?>
</address>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "<?= $contact->contacts_category_id == '1' ? 'http://schema.org/PoliceStation' : 'http://schema.org/CivicStructure' ?>"
  ,"address": {
    "@type": "PostalAddress",
    "addressLocality": "<?= $contact->city ?>",
    "postalCode": "<?= $contact->postcode ?>",
    "streetAddress": "<?= $contact->street ?> <?= $contact->number ?>"
  }
  <? if($contact->misc) : ?>
  ,"description": "<?= trim(preg_replace('/\s\s+/', ' ', strip_tags($contact->misc))) ?>"
  <? endif ?>
  ,"name": "<?= $contact->title ?>"
  <? if($contact->telephone) : ?>
  ,"telephone": "<?= $contact->telephone ?>"
  <? endif ?>
  <? if($contact->fax) : ?>
  ,"faxNumber": "<?= $contact->fax ?>"
  <? endif ?>
  <? if($contact->email) : ?>
  ,"email": "<?= $contact->email ?>"
  <? endif ?>
  <? if($contact->url) : ?>
  ,"sameAs": "<?= $contact->url ?>"
  <? endif ?>
  <? if(isset($thumbnail)) : ?>
  ,"photo": "attachments://<?= $thumbnail ?>"
  <? endif ?>
  <?= object('com:contacts.controller.hour')->contact($contact->id)->layout('schema')->render(array('contact' => $contact)); ?>
}
</script>
