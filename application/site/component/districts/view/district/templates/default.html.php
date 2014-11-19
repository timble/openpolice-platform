<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<title content="replace"><?= escape($district->title) ?></title>

<div class="article">
    <h1 class="article__header">
        <?= @translate('Your district officer') ?>
    </h1>

    <? $officers = object('com:districts.model.districts_officers')->district($district->id)->getRowset(); ?>

    <? if(count($officers)) : ?>
    <div class="districts__officers">
        <? foreach ($officers as $officer) : ?>
            <div class="districts__officer">
                <?= import('com:districts.view.district.default_officer.html', array('officer' => object('com:districts.model.officers')->id($officer->districts_officer_id)->getRow())); ?>
            </div>
        <? endforeach ?>
    </div>
    <? else : ?>
    <h2><?= translate('No neighbourhood officer found') ?></h2>
    <? endif ?>

    <? if($contact->id) : ?>
    <div class="districts__contact">
        <?= import('default_contact.html', array('contact' => $contact)); ?>
    </div>
    <? endif ?>
</div>

<? if(isset($bin)) : ?>
<div class="article">
    <h1 class="article__header">
        <?= @translate('Your neighborhood information network') ?>
    </h1>
    <?= import('default_bin.html', array('bin' => $bin)); ?>
</div>
<? endif; ?>
