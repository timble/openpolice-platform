<?
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<title content="replace"><?= escape($district->title) ?></title>

<h1 class="article__header">
    <?= escape($district->title) ?>
</h1>

<?= import('default_coordinator.html'); ?>
<?= import('default_district.html'); ?>
