<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<div<?= $class ? ' class="'.$class.'"' : '' ?>>
    <? if($show_title) : ?>
        <h3><?= $module->title ?></h3>
    <? endif ?>

    <?= $module->content ?>
</div>