<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<ktml:module position="left">
    <?= import('com:wanted.view.sections.list.html') ?>
</ktml:module>

<title content="replace"><?= escape($title) ?></title>

<h1><?= escape($title) ?></h1>
<?= import('default_list.html') ?>

<?= helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>