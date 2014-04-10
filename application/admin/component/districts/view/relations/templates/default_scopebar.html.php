<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<div class="scopebar">
    <div class="scopebar__group">
        <a class="<?= is_null($state->search) && is_null($state->street) ? 'active' : ''; ?>" href="<?= route('search=&street=' ) ?>">
            <?= translate('All') ?>
        </a>
    </div>
    <div class="scopebar__group">
        <a class="<?= $state->street === '0' ? 'active' : ''; ?>" href="<?= route('street=0') ?>">
            <?= translate('No street') ?>
        </a>
    </div>
    <div class="scopebar__search">
        <?= helper('grid.search') ?>
    </div>
</div>