<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<div class="scopebar">
	<div class="scopebar__group">
		<a class="<?= is_null($state->enabled) ? 'active' : '' ?>" href="<?= route('enabled=' ) ?>">
		    <?= translate('All') ?>
		</a>
	</div>
	<div class="scopebar__group">
		<a class="<?= $state->enabled === true ? 'active' : '' ?>" href="<?= route($state->enabled === true ? 'enabled=' : 'enabled=1' ) ?>">
		    <?= translate('Enabled') ?>
		</a> 
		<a class="<?= $state->enabled === false ? 'active' : '' ?>" href="<?= route($state->enabled === false ? 'enabled=' : 'enabled=0' ) ?>">
		    <?= translate('Disabled') ?>
		</a> 
	</div>
	<div class="scopebar__search">
		<?= helper('grid.search') ?>
	</div>
</div>