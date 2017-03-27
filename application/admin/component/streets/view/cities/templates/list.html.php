<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<ul class="navigation">
    <li>
        <a class="<?= $state->city == null ? 'active' : ''; ?>" href="<?= route('city=' ) ?>">
            <?= 'All cities' ?>
        </a>
    </li>
    <? foreach ($cities as $city) : ?>
        <li>
            <a class="<?= $state->city == $city->id ? 'active' : ''; ?>" href="<?= route('city='.$city->id ) ?>">
                <?= escape($city->title) ?>
            </a>
        </li>
    <? endforeach ?>
</ul>