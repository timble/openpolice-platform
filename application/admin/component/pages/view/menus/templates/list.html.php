<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<ul class="navigation">
    <? foreach($applications as $application) : ?>
        <h4><?= $application ?></h4>
        <? foreach($menus->find(array('application' => $application)) as $menu) : ?>
        <li>
            <a class="<?= $state->menu == $menu->id ? 'active' : '' ?>" href="<?= route('view=pages&menu='.$menu->id ) ?>">
                <span class="navigation__text"><?= escape($menu->title) ?></span>
                <span class="navigation__badge"><?= $menu->page_count ?></span>
            </a>
        </li>
        <? endforeach ?>
    <? endforeach ?>
</ul>
