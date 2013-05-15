<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<div class="scopebar">
    <div class="scopebar-group">
        <a class="<?= is_null($state->search) && is_null($state->parent_id) ? 'active' : ''; ?>" href="<?= @route('search=&parent_id' ) ?>">
            <?= @text('All') ?>
        </a>
    </div>
    <div class="scopebar-search">
        <?= @helper('grid.search') ?>
    </div>
</div>