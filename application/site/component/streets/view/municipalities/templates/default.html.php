<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h1><?= translate('Search your police force') ?></h1>

<form class="form" action="#" method="get">
    <div class="form__group">
        <label class="form__label" for="municipality" ><?= translate('City or postal code') ?>:</label>
        <input class="form__input" autofocus type="text" value="<?= $state->search ? $state->search : '' ?>" name="search" onfocus="this.value = this.value;">
    </div>
    <button class="button button--primary search-box__button"><?= translate('Search') ?></button>
</form>

<? if($state->search) : ?>
<ul>
    <? foreach ($municipalities as $municipality) : ?>
        <li><a href="?municipality=<?= $municipality->streets_municipality_id.'&language='.$municipality->language ?>"><?= $municipality->title ?></a></li>
    <? endforeach ?>
</ul>
<? if(!count($municipalities)) : ?>
    <?= translate('No results found') ?>
<? endif ?>
<?= helper('paginator.pagination', array('total' => $total, 'show_limit' => false, 'show_count' => false)); ?>
<? endif ?>
