<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h1 class="article__header"><?= escape($params->get('page_title')); ?></h1>

<? if ($category->image || $category->description) : ?>
<div class="clearfix">
    <? if ($category->image) : ?>
        <?= helper('com:categories.string.image', array('row' => $category)) ?>
    <? endif; ?>
    <?= $category->description; ?>
</div>
<? endif; ?>

<? if(object('application')->getCfg('site') != '5455') : ?>
<?= import('default_search.html'); ?>
<? endif ?>
