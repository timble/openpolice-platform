<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<h3><?= translate('Categories')?></h3>
<?= import('com:articles.view.categories.list.html', array('categories' => object('com:articles.model.categories')->sort('title')->table('questions')->getRowset())); ?>