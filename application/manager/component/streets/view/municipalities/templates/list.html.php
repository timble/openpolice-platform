<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<ul class="navigation">
	<a class="<?= $state->municipality == null ? 'active' : ''; ?>" href="<?= route('municipality=' ) ?>">
		<?= 'All municipality' ?>
	</a>
	<? foreach ($municipalities as $municipality) : ?>
	<a class="<?= $state->municipality == $municipality->id ? 'active' : ''; ?>" href="<?= route('municipality='.$municipality->id ) ?>">
		<?= escape($municipality->title) ?>
	</a>
	<? endforeach ?>
</ul>