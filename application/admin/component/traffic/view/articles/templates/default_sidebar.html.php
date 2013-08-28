<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<h3><?= translate('Categories') ?></h3>
<?= import('com:categories.view.categories.list.html', array('categories' => object('com:traffic.model.categories')->sort('title')->table('traffic')->getRowset())); ?>