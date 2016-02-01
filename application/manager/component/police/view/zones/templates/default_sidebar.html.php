<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<h3><?= translate('Districts')?></h3>
<?= import('com:streets.view.districts.list.html', array('districts' => object('com:streets.model.districts')->sort('title')->getRowset())); ?>

<h3><?= translate('Provinces')?></h3>
<?= import('com:streets.view.provinces.list.html', array('provinces' => object('com:streets.model.provinces')->sort('title')->getRowset())); ?>