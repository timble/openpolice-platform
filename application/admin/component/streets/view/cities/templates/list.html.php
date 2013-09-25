<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<ul class="navigation">
    <a class="<?= $state->city == null ? 'active' : ''; ?>" href="<?= route('city=' ) ?>">
        <?= 'All cities' ?>
    </a>
    <? foreach ($cities as $city) : ?>
        <a class="<?= $state->city == $city->id ? 'active' : ''; ?>" href="<?= route('city='.$city->id ) ?>">
            <?= escape($city->title) ?>
        </a>
    <? endforeach ?>
</ul>