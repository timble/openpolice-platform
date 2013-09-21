<?
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<div class="scopebar">
    <div class="scopebar__group">
        <a class="<?= is_null($state->search) && is_null($state->islp) ? 'active' : ''; ?>" href="<?= route('search=&islp=' ) ?>">
            <?= translate('All') ?>
        </a>
    </div>
    <div class="scopebar__group">
        <a class="<?= $state->islp === 0 ? 'active' : ''; ?>" href="<?= route($state->islp === 0 ? 'islp=' : 'islp=0' ) ?>">
            <?= 'Missing ISLP' ?>
        </a>
    </div>
    <div class="scopebar__search">
        <?= helper('grid.search') ?>
    </div>
</div>