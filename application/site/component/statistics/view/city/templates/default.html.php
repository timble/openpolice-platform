<?php
/**
 * Belgian Police Web Platform - Statistics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
 ?>

<title content="replace"><?= translate('Crime Statistics') ?> - <?= escape($city->title) ?></title>

<h1><?= escape($city->title) ?></h1>
<h2><?= translate('Crime Statistics') ?></h2>

<? $zone = object('com:police.model.zones')->id($city->police_zone_id)->getRow(); ?>

<h3>2000 - 2014</h3>

<ul>
    <li>
        <a download="<?= object('lib:filter.slug')->sanitize($city->title).'_'.$language->slug ?>" href="<?= 'files://'.'crime/city/'.$city->id.'_'.$language->slug.'.pdf' ?>">
            <?= $city->title ?> (pdf, 1 MB)
        </a>
    </li>
    <li>
        <a download="<?= object('lib:filter.slug')->sanitize($zone->title).'_'.$language->slug ?>" href="<?= 'files://'.'crime/zone/'.$city->police_zone_id.'_'.$language->slug.'.pdf' ?>">
            <?= translate('Police zone') ?> <?= $zone->title ?> (pdf, 1 MB)
        </a>
    </li>
    <li>
        <a download="<?= object('lib:filter.slug')->sanitize($city->province).'_'.$language->slug ?>" href="<?= 'files://'.'crime/province/'.$city->streets_province_id.'_'.$language->slug.'.pdf' ?>">
            <?= $city->province ?> (pdf, 1,5 MB)
        </a>
    </li>
    <li>
        <a download="<?= object('lib:filter.slug')->sanitize($city->region).'_'.$language->slug ?>" href="<?= 'files://'.'crime/region/'.$city->streets_region_id.'_'.$language->slug.'.pdf' ?>">
            <?= $city->region ?> (pdf, 1,5 MB)
        </a>
    </li>
    <li>
        <a download="<?= object('lib:filter.slug')->sanitize(translate('Belgium')).'_'.$language->slug ?>" href="<?= 'files://'.'crime/national/'.$language->slug.'.pdf' ?>">
            <?= translate('Belgium') ?> (pdf, 1,7 MB)
        </a>
    </li>
</ul>

<h3><?= translate('Nomenclature') ?></h3>

<ul>
<? foreach($notes as $note) : ?>
    <li>
        <a href="<?= 'files://'.'crime/notes/'.$language->slug.'/'.object('lib:filter.slug')->sanitize(str_replace("é","e",translate($note))).'.pdf' ?>">
            <?= translate($note) ?>
        </a>
    </li>
<? endforeach ?>
</ul>
