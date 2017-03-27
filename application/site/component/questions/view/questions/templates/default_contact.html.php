<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? if($contacts_contact_id = $params->get('contacts_contact_id', false)) : ?>
    <? $contact = object('com:contacts.model.contacts')->id($contacts_contact_id)->published(true)->getRow(); ?>
    <? if(!$contact->isNew()) : ?>
        <?
        $site = object('application')->getCfg('site');
        $zone = object('com:police.model.zone')->id($site)->getRow();

        $languages  = $this->getObject('application.languages');
        $active     = $languages->getActive();

        $path = '/'.$site;
        $path .= count($languages) > '1' ? '/'.$active->slug : '';
        $path .= '/'.strtolower(translate('contact')).'/'.$contact->category_slug.'/'.$contact->id.'-'.$contact->slug;
        ?>

        <div class="well well--small text-center">
            <?= translate('Your question remains unanswered?') ?> <a href="<?= $path ?>"><?= translate('Contact us') ?></a>.
        </div>
    <? endif; ?>
<? else : ?>
    <? $email = str_replace("@", "&#64;", $zone->email) ?>
    <? $email = str_replace(".", "&#46;", $email) ?>

    <div class="well well--small text-center">
        <?= translate('Your question remains unanswered?') ?> <?= translate('Contact us at') ?> <a href="mailto:<?= $email ?>"><?= $email ?></a><? if($zone->phone_information) : ?> <?= translate('or') ?> <span class="nowrap"><?= $zone->phone_information ?></span><? endif ?>.
    </div>
<? endif; ?>
