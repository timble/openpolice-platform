<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<div class="scopebar">
    <div class="scopebar__group">
        <a class="<?= is_null($state->matches) || !count($state->matches) ? 'active' : ''; ?>" href="<?= route('matches=' ) ?>">
            <?= translate('All') ?>
        </a>
    </div>
    <div class="scopebar__group">
        <? foreach($statuses as $status) : ?>
            <a class="<?= isset($state->matches['status']) && $state->matches['status'] == $status ? 'active' : ''; ?>" href="<?= route('matches[status]='.$status) ?>">
                <?= translate($status) ?>
            </a>
        <? endforeach ?>
    </div>
</div>