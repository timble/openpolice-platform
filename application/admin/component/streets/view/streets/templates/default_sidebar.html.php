<?
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h3><?= translate('Cities')?></h3>
<?= import('com:streets.view.cities.list.html', array('cities' => object('com:streets.model.cities')->sort('title')->getRowset())); ?>