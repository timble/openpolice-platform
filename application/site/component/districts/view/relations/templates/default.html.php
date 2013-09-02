<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<?= import('com:districts.view.search.default.html'); ?>

<? if ($state->street) : ?>
    <ul>
        <? foreach ($relations as $relation) : ?>
        <li>
            <a href="<?= helper('route.district', array('row' => $relation)) ?>">
                <?= $relation->street ?> <?= helper('string.street', array('row' => $relation)) ?>
            </a>
        </li>
        <? endforeach; ?>
    </ul>
    <? if(!count($relations)) : ?>
        <h2><?= translate('No neighbourhood officer found') ?></h2>
    <? endif ?>

    <?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
<? endif ?>