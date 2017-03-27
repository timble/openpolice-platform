<?
/**
 * Belgian Police Web Platform - Theme
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h1><?= escape($params->get('page_title')); ?></h1>

<? if ($category->image || $category->description) : ?>
    <div class="clearfix">
        <? if ($category->image) : ?>
            <?= helper('com:categories.string.image', array('row' => $category)) ?>
        <? endif; ?>
        <?= $category->description; ?>
    </div>
<? endif; ?>

<ul class="categories_wrapper">
    <? foreach ($contacts as $contact): ?>
    <li>
        <a href="<?= helper('route.contact', array('row' => $contact)) ?>"><?= $contact->title ?></a>
    </li>
    <? endforeach; ?>
</ul>

<?= helper('paginator.pagination', array('total' => $total, 'show_limit' => false, 'show_count' => false)); ?>
