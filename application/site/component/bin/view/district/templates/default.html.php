<?
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<title content="replace"><?= escape($district->title) ?></title>

<h1 class="article__header">
    <?= escape($district->title) ?>
</h1>

<div class="districts__coordinators">
    <div class="districts__coordinator">
        <?= import('com:bin.view.district.default_coordinator.html', array('coordinator' => $district)); ?>
    </div>
</div>