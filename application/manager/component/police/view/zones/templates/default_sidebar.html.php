<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h3><?= translate('Provinces')?></h3>
<?= import('com:streets.view.provinces.list.html', array('provinces' => object('com:streets.model.provinces')->sort('title')->getRowset())); ?>

<h3><?= translate('Districts')?></h3>
<?= import('com:streets.view.districts.list.html', array('districts' => object('com:streets.model.districts')->province($state->province)->sort('title')->getRowset())); ?>

