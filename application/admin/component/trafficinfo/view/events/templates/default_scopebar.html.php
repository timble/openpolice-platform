<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<div class="scopebar">
    <div class="scopebar__group">
        <a class="<?= is_null($state->search) ? 'active' : ''; ?>" href="<?= @route('search=' ) ?>">
            <?= @text('All') ?>
        </a>
    </div>
    <div class="scopebar__search">
        <?= @helper('grid.search') ?>
    </div>
</div>