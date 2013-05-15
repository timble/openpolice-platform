<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

    <h3><?= @text('Categories') ?></h3>
<?= @template('com:categories.view.categories.list.html', array('categories' => @object('com:trafficinfo.model.categories')->sort('title')->getRowset())); ?>