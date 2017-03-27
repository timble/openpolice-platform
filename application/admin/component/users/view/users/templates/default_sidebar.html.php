<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h3><?= translate('Roles') ?></h3>
<ul class="navigation">
	<li>
        <a class="<?= is_null($state->role) ? 'active' : ''; ?>" href="<?= route('role=') ?>">
            <?= translate('All roles') ?>
        </a>
	</li>
	<? foreach($roles as $role) : ?>
    <li>
        <a <?= $state->role == $role->id ? 'class="active"' : '' ?> href="<?= route('role='.$role->id) ?>">
            <?= $role->name ?>
        </a>
    </li>
	<? endforeach ?>
</ul>

<h3><?= translate('Groups') ?></h3>
<ul class="navigation">
	<li>
        <a class="<?= is_null($state->group) ? 'active' : ''; ?>" href="<?= route('group=') ?>">
            <?= translate('All groups') ?>
        </a>
	</li>

	<? foreach($groups as $group) : ?>
    <li>
        <a <?= $state->group == $group->id ? 'class="active"' : '' ?> href="<?= route('group='.$group->id) ?>">
            <?= $group->name ?>
        </a>
    </li>
	<? endforeach ?>
</ul>