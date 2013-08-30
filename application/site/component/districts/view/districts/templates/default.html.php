<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<h1 class="article__header"><?= escape($params->get('page_title')); ?></h1>

<?= import('default_search.html'); ?>

<? if ($state->street && $state->number) : ?>

    <? foreach ($districts as $district) : ?>
        <?= import('com:districts.view.district.default.html', array('district' => $district)); ?>
    <? endforeach; ?>
    <? if(!count($districts)) : ?>
        <h2><?= translate('No neighbourhood officer found') ?></h2>
        <h3><?= translate('Try again or get in touch with one of our locations') ?></h3>
        <?= import('com:districts.view.locations.default.html', array('locations' => object('com:zone.model.locations')->getRowset())); ?>
    <? endif ?>
<? endif ?>