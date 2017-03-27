<?
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<div class="scopebar">
    <div class="scopebar__group">
        <a class="<?= is_null($state->search) && is_null($state->type) && is_null($state->action) ? 'active' : ''; ?>" href="<?= route('search=&type=&action=' ) ?>">
            <?= translate('All') ?>
        </a>
    </div>
    <div class="scopebar__group">
        <a class="<?= $state->type == 'street' ? 'active' : ''; ?>" href="<?= route($state->type == 'street' ? 'type=' : 'type=street' ) ?>">
            <?= translate('Street') ?>
        </a>
        <a class="<?= $state->type == 'city' ? 'active' : ''; ?>" href="<?= route($state->type == 'city' ? 'type=' : 'type=city' ) ?>">
            <?= translate('City') ?>
        </a>
    </div>
    <div class="scopebar__group">
        <a class="<?= $state->action == 'add' ? 'active' : ''; ?>" href="<?= route($state->action == 'add' ? 'action=' : 'action=add' ) ?>">
            <?= translate('Add') ?>
        </a>
        <a class="<?= $state->action == 'edit' ? 'active' : ''; ?>" href="<?= route($state->action == 'edit' ? 'action=' : 'action=edit' ) ?>">
            <?= translate('Edit') ?>
        </a>
        <a class="<?= $state->action == 'delete' ? 'active' : ''; ?>" href="<?= route($state->action == 'delete' ? 'action=' : 'action=delete' ) ?>">
            <?= translate('Delete') ?>
        </a>
    </div>
    <div class="scopebar__search">
        <?= helper('grid.search') ?>
    </div>
</div>