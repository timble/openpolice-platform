<?
/**
 * Belgian Police Web Platform - Press Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? $contact = object('com:contacts.model.contacts')->id('30')->published('true')->getRow(); ?>

<? if($contact) : ?>
<? $email = str_replace("@", "&#64;", $contact->email_to) ?>
<? $email = str_replace(".", "&#46;", $email) ?>

<div class="well well--small text-center" style="margin-top: 30px">
    <?= sprintf(translate('Contact the %s at'), $contact->title) ?> <a href="mailto:<?= $email ?>"><?= $email ?></a> <? if($contact->mobile || $contact->telephone) : ?><?= translate('or') ?> <?= $contact->telephone ? $contact->telephone : $contact->mobile ?><? endif ?>.
</div>
<? endif; ?>
