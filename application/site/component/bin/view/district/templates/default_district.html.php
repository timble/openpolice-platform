<?
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? $relation = object('com:districts.model.relations')->street($state->street)->number($state->number)->getRowset()->top(); ?>
<? $officers = object('com:districts.model.districts_officers')->district($relation->districts_district_id)->getRowset(); ?>

<div class="districts__officers">
    <h2><?= translate('District officer') ?></h2>
    <? if(count($officers)) : ?>
        <? foreach ($officers as $officer) : ?>
            <div class="districts__officer">
                <?= import('com:districts.view.district.default_officer.html', array('officer' => object('com:districts.model.officers')->id($officer->districts_officer_id)->getRow(), 'heading' => '1')); ?>
            </div>
        <? endforeach ?>
    <? else : ?>
    <h3><?= translate('No neighbourhood officer found') ?></h3>
    <? endif ?>
</div>

<? if($contact = object('com:districts.model.districts')->id($relation->districts_district_id)->getRow()->contacts_contact_id) : ?>
<div class="districts__contact">
    <?= import('com:districts.view.district.default_contact.html', array('contact' => object('com:contacts.model.contacts')->id($contact)->getRow())); ?>
</div>
<? endif ?>
