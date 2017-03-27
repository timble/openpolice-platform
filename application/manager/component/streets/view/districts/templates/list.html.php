<?
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<ul class="navigation">
    <li>
        <a class="<?= $state->district == null ? 'active' : ''; ?>" href="<?= route('district=' ) ?>">
            <?= 'All districts' ?>
        </a>
    </li>
    <? foreach ($districts as $district) : ?>
        <li>
            <a class="<?= $state->district == $district->id ? 'active' : ''; ?>" href="<?= route('district='.$district->id ) ?>">
                <?= escape($district->title) ?>
            </a>
        </li>
    <? endforeach ?>
</ul>