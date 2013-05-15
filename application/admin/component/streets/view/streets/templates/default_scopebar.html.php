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
    <div class="scopebar-group">
        <a class="<?= is_null($state->search) ? 'active' : ''; ?>" href="<?= @route('search=' ) ?>">
            <?= @text('All') ?>
        </a>
    </div>
    <div class="scopebar-search">
        <?= @helper('grid.search') ?>
    </div>
</div>