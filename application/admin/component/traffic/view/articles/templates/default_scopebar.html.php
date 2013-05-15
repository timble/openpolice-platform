<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<div class="scopebar">
    <div class="scopebar-group">
        <a class="<?= is_null($state->search) && is_null($state->date) && is_null($state->published) ? 'active' : ''; ?>" href="<?= @route('search=&date=&published=' ) ?>">
            <?= @text('All') ?>
        </a>
    </div>
    <div class="scopebar-group">
    	<a class="<?= $state->published === 1 ? 'active' : ''; ?>" href="<?= @route($state->published === 1 ? 'published=' : 'published=1' ) ?>">
    	    <?= 'Published' ?>
    	</a>
    	<a class="<?= $state->published === 0 ? 'active' : ''; ?>" href="<?= @route($state->published === 0 ? 'published=' : 'published=0' ) ?>">
    	    <?= 'Unpublished' ?>
    	</a>
    </div>
    <div class="scopebar-group">
        <a class="<?= $state->date == 'past' ? 'active' : ''; ?>" href="<?= @route('date=past') ?>">
            <?= 'Past' ?>
        </a>
        <a class="<?= $state->date == 'upcoming' ? 'active' : ''; ?>" href="<?= @route('date=upcoming') ?>">
            <?= 'Upcoming' ?>
        </a>
    </div>
    <div class="scopebar-search">
        <?= @helper('grid.search') ?>
    </div>
</div>