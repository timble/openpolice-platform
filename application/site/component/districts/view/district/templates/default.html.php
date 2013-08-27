<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<? $officers = object('com:districts.model.districts_officers')->district($district->id)->getRowset(); ?>

<? if(count($officers)) : ?>
<div class="clearfix article separator">
	<? foreach ($officers as $officer) : ?>
		<?= import('com:districts.view.district.default_officer.html', array('officer' => object('com:districts.model.officers')->id($officer->districts_officer_id)->getRow())); ?>
	<? endforeach ?>
</div>
<? else : ?>
<h2><?= translate('No neighbourhood officer found') ?></h2>
<? endif ?>
<div class="clearfix">
	<?
        $contact = object('com:contacts.model.contact')->id($district->contacts_contact_id)->getRow();
        $contact->misc = null;
    ?>
    <?= import('com:contacts.view.contact.hcard.html', array('contact' => $contact)); ?>
</div>