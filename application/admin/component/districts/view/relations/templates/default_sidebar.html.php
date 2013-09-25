<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<h3><?= translate('Districts')?></h3>
<?= import('com:districts.view.districts.list.html', array('districts' => object('com:districts.model.districts')->sort('title')->getRowset())); ?>