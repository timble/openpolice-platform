<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
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
