<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<h3><?= @text('Districts')?></h3>
<?= @template('com:districts.view.districts.list.html', array('districts' => @object('com:districts.model.districts')->sort('title')->getRowset())); ?>