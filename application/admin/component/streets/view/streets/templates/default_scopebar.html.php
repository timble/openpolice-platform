<?
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<div class="scopebar">
    <div class="scopebar__group">
        <a class="<?= is_null($state->search) && is_null($state->no_islp) && is_null($state->no_district) ? 'active' : ''; ?>" href="<?= route('search=&no_islp=&no_district=' ) ?>">
            <?= translate('All') ?>
        </a>
    </div>
    <div class="scopebar__group">
        <a class="<?= $state->no_islp ? 'active' : ''; ?>" href="<?= route($state->no_islp ? 'no_islp=' : 'no_islp=1' ) ?>">
            <?= 'Missing ISLP' ?>
        </a>
        <a class="<?= $state->no_district ? 'active' : ''; ?>" href="<?= route(is_numeric($state->no_district) ? 'no_district=' : 'no_district=1' ) ?>">
            <?= @translate('No district officer') ?>
        </a>
    </div>
    <div class="scopebar__search">
        <?= helper('grid.search') ?>
    </div>
</div>