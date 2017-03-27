<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<div class="scopebar">
    <div class="scopebar__group">
        <a class="<?= is_null($state->search) && is_null($state->platform) && is_null($state->language) ? 'active' : ''; ?>" href="<?= route('search=&platform=&language=' ) ?>">
            <?= translate('All') ?>
        </a>
    </div>
    <div class="scopebar__group">
        <a class="<?= $state->platform == '1' ? 'active' : ''; ?>" href="<?= route($state->platform == '1' ? 'platform=' : 'platform=1' ) ?>">
            <?= translate('Platform v1') ?>
        </a>
        <a class="<?= $state->platform == '2' ? 'active' : ''; ?>" href="<?= route($state->platform == '2' ? 'platform=' : 'platform=2' ) ?>">
            <?= translate('Platform v2') ?>
        </a>
    </div>
    <div class="scopebar__group">
        <a class="<?= $state->language == '1' ? 'active' : ''; ?>" href="<?= route($state->language == '1' ? 'language=' : 'language=1' ) ?>">
            <?= translate('NL') ?>
        </a>
        <a class="<?= $state->language == '2' ? 'active' : ''; ?>" href="<?= route($state->language == '2' ? 'language=' : 'language=2' ) ?>">
            <?= translate('FR') ?>
        </a>
        <a class="<?= $state->language == '3' ? 'active' : ''; ?>" href="<?= route($state->language == '3' ? 'language=' : 'language=3' ) ?>">
            <?= translate('NL & FR') ?>
        </a>
        <a class="<?= $state->language == '4' ? 'active' : ''; ?>" href="<?= route($state->language == '4' ? 'language=' : 'language=4' ) ?>">
            <?= translate('DE') ?>
        </a>
    </div>
    <div class="scopebar__search">
        <?= helper('grid.search') ?>
    </div>
</div>