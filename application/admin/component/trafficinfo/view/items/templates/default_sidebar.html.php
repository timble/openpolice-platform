<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<h3><?= @text('Lists')?></h3>
<nav class="scrollable">
	<a class="<?= $state->group == null ? 'active' : ''; ?>" href="<?= @route('group=' ) ?>">
		<?= 'All groups' ?>
	</a>
	<a class="<?= $state->group == 'incident' ? 'active' : ''; ?>" href="<?= @route('group=incident' ) ?>">
		<?= @text('Incident') ?>
	</a>
	<a class="<?= $state->group == 'situation' ? 'active' : ''; ?>" href="<?= @route('group=situation' ) ?>">
		<?= @text('Situation') ?>
	</a>
	<a class="<?= $state->group == 'traffic' ? 'active' : ''; ?>" href="<?= @route('group=traffic' ) ?>">
		<?= @text('Traffic') ?>
	</a>
	<a class="<?= $state->group == 'source' ? 'active' : ''; ?>" href="<?= @route('group=source' ) ?>">
		<?= @text('Source') ?>
	</a>
	<a class="<?= $state->group == 'roads' ? 'active' : ''; ?>" href="<?= @route('group=roads' ) ?>">
		<?= @text('Roads') ?>
	</a>
	<a class="<?= $state->group == 'places' ? 'active' : ''; ?>" href="<?= @route('group=places' ) ?>">
		<?= @text('Places') ?>
	</a>
	<a class="<?= $state->group == 'text' ? 'active' : ''; ?>" href="<?= @route('group=text' ) ?>">
		<?= @text('Texts') ?>
	</a>
</nav>