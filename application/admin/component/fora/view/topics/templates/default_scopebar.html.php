<div class="scopebar">
    <div class="scopebar__group">
        <a class="<?= is_null($state->search) && is_null($state->created_by) ? 'active' : ''; ?>" href="<?= route('search=&created_by=' ) ?>">
            <?= translate('All') ?>
        </a>
    </div>
    <div class="scopebar__group">
        <a class="<?= is_numeric($state->created_by) ? 'active' : ''; ?>" href="<?= route(is_numeric($state->created_by) ? 'created_by=' : 'created_by='.$fora_user->id) ?>">
            <?= 'Created by me' ?>
        </a>
    </div>
    <div class="scopebar__search">
        <?= helper('grid.search') ?>
    </div>
</div>