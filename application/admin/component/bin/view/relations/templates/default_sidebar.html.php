<?
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h3><?= translate('Bin')?></h3>
<?= import('com:bin.view.districts.list.html', array('districts' => object('com:bin.model.districts')->sort('title')->getRowset())); ?>