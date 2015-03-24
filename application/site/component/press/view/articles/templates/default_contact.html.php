<?
/**
 * Belgian Police Web Platform - Press Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? if($contacts_contact_id = $params->get('contacts_contact_id', false)) : ?>
<? $contact = object('com:contacts.model.contacts')->id($contacts_contact_id)->published(true)->getRow(); ?>
<? if(!$contact->isNew()) : ?>
<?
$email = str_replace("@", "&#64;", $contact->email_to);
$email = str_replace(".", "&#46;", $email);

$site = object('application')->getCfg('site');
$zone = object('com:police.model.zone')->id($site)->getRow();

$languages  = $this->getObject('application.languages');
$active     = $languages->getActive();

$path = '/'.$site;
$path .= count($languages) > '1' ? '/'.$active->slug : '';
$path .= '/'.strtolower(translate('contact')).'/'.$contact->category_slug.'/'.$contact->id.'-'.$contact->slug;
?>

<div class="well well--small text-center" style="margin-top: 30px">
    <?= sprintf(translate('Contact the %s at'), '<a href="'.$path.'">'.$contact->title.'<a>') ?> <a href="mailto:<?= $email ?>"><?= $email ?></a> <? if($contact->mobile || $contact->telephone) : ?><?= translate('or') ?> <?= $contact->telephone ? $contact->telephone : $contact->mobile ?><? endif ?>.
</div>
<? endif; ?>
<? endif; ?>
