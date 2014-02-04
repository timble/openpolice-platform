<div class="scopebar">
    <div class="scopebar__group">
        <a class="<?= is_null($state->search) ? 'active' : ''; ?>" href="<?= route('search=' ) ?>">
            <?= translate('All') ?>
        </a>
    </div>
    <div class="scopebar__search">
        <?= helper('grid.search') ?>
    </div>
</div>