<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
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