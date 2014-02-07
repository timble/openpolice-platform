<div class="scopebar">
    <div class="scopebar__group">
        <a class="<?= is_null($state->search) && is_null($state->created_by) && is_null($state->status) ? 'active' : ''; ?>" href="<?= route('search=&created_by=&status' ) ?>">
            <?= translate('All') ?>
        </a>
    </div>
    <div class="scopebar__group">
        <a class="<?= is_numeric($state->created_by) ? 'active' : ''; ?>" href="<?= route(is_numeric($state->created_by) ? 'created_by=' : 'created_by='.$user) ?>">
            <?= 'Created by me' ?>
        </a>
    </div>
    <div class="scopebar__group">
        <? foreach($statuses as $status) : ?>
            <a class="<?= $state->status == $status ? 'active' : ''; ?>" href="<?= route('status='.$status) ?>">
                <?= $status ?>
            </a>
        <? endforeach ?>
    </div>
    <div class="scopebar__search">
        <?= helper('grid.search') ?>
    </div>
</div>