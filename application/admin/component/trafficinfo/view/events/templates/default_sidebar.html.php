<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

    <h3><?= translate('Categories') ?></h3>
<?= import('com:categories.view.categories.list.html', array('categories' => object('com:trafficinfo.model.categories')->sort('title')->getRowset())); ?>