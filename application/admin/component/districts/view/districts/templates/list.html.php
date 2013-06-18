<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<ul class="navigation">
	<a class="<?= $state->district == null ? 'active' : ''; ?>" href="<?= @route('district=' ) ?>">
		<?= 'All districts' ?>
	</a>
	<? foreach ($districts as $district) : ?>
	<a class="<?= $state->district == $district->id ? 'active' : ''; ?>" href="<?= @route('district='.$district->id ) ?>">
		<?= @escape($district->title) ?>
	</a>
	<? endforeach ?>
</ul>