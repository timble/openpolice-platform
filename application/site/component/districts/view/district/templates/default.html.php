<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<title content="replace"><?= escape($district->title) ?></title>

<h1>
    <?= escape($district->title) ?>
</h1>

<? $officers = object('com:districts.model.districts_officers')->district($district->id)->getRowset(); ?>

<div class="grid-row">
    <div class="column column--one-half">
        <h2><?= translate('Your local policing team') ?></h2>
        <? if(count($officers)) : ?>
            <? foreach ($officers as $officer) : ?>
                <div class="districts__officer">
                    <?= import('com:districts.view.district.default_officer.html', array('officer' => object('com:districts.model.officers')->id($officer->districts_officer_id)->getRow())); ?>
                </div>
            <? endforeach ?>
        <? else : ?>
        <p><?= translate('No neighbourhood officer found') ?></p>
        <? endif ?>
    </div>

    <? if($contact->id) : ?>
    <div class="column column--one-half">
        <?= import('default_contact.html', array('contact' => $contact)); ?>
    </div>
    <? endif ?>
</div>


<? if($state->street && $state->number && count($this->getObject('com:bin.model.relations')->getRowset())) : ?>
    <div class="article">
    <h1 class="article__header">
        <?= @translate('Your neighborhood information network') ?>
    </h1>
    <p><?= translate('A neighborhood information network is a partnership between citizens and the police within a certain area'); ?>. <a href="/<?= $site ?>/<?= strtolower(translate('questions')) ?>/<?= translate('neighborhood-information-network') ?>"><?= translate('More information') ?></a>.</p>
    <? if(isset($bin)) : ?>
        <p><?= translate('Contact your coordinator to join') ?>:</p>
        <?= import('default_bin.html', array('bin' => $bin)); ?>
    <? endif; ?>
    <? if(!isset($bin)) : ?>
        <? $email = str_replace("@", "&#64;", $zone->email) ?>
        <? $email = str_replace(".", "&#46;", $email) ?>

    <p><?= translate('Your street is not yet part of a neighborhood information network') ?>. <?= sprintf(translate('Contact your district officer or email us at %s to join an existing neighborhood information network or to start a new neighborhood information network'), '<a class="email" href="mailto:'.$email.'">'.$email.'</a>') ?>.</p>
    <? endif; ?>
    </div>
<? endif ?>
