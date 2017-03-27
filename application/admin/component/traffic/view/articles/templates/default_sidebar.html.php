<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h3><?= translate('Categories') ?></h3>
<?= import('com:categories.view.categories.list.html', array('categories' => object('com:traffic.model.categories')->sort('title')->getRowset())); ?>