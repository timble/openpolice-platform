<?
/**
 * Belgian Police Web Platform - Trafficinfo Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<h3><?= translate('Lists')?></h3>
<ul class="navigation">
	<a class="<?= $state->group == null ? 'active' : ''; ?>" href="<?= route('group=' ) ?>">
		<?= 'All groups' ?>
	</a>
	<a class="<?= $state->group == 'incident' ? 'active' : ''; ?>" href="<?= route('group=incident' ) ?>">
		<?= translate('Incident') ?>
	</a>
	<a class="<?= $state->group == 'situation' ? 'active' : ''; ?>" href="<?= route('group=situation' ) ?>">
		<?= translate('Situation') ?>
	</a>
	<a class="<?= $state->group == 'traffic' ? 'active' : ''; ?>" href="<?= route('group=traffic' ) ?>">
		<?= translate('Traffic') ?>
	</a>
	<a class="<?= $state->group == 'source' ? 'active' : ''; ?>" href="<?= route('group=source' ) ?>">
		<?= translate('Source') ?>
	</a>
	<a class="<?= $state->group == 'roads' ? 'active' : ''; ?>" href="<?= route('group=roads' ) ?>">
		<?= translate('Roads') ?>
	</a>
	<a class="<?= $state->group == 'places' ? 'active' : ''; ?>" href="<?= route('group=places' ) ?>">
		<?= translate('Places') ?>
	</a>
	<a class="<?= $state->group == 'text' ? 'active' : ''; ?>" href="<?= route('group=text' ) ?>">
		<?= translate('Texts') ?>
	</a>
</ul>