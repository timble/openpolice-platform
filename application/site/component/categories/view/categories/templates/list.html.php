<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<ul>
    <? foreach ($categories as $category): ?>
    <li<?= $category->id == $state->category ? ' class="active"' : '' ?>>
        <a href="<?= helper('route.category', array('row' => $category)) ?>">
            <?= $category->title ?>
        </a>
    </li>
    <? endforeach ?>
</ul>