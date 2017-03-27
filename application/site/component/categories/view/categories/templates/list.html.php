<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
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