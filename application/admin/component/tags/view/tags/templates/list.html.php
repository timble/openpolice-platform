<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<script src="assets://tags/js/tags.js" />
<style src="assets://tags/css/tags-list.css" />

<? $disabled = $disabled ? 'disabled="disabled"' : ''; ?>

<div id="tags-list">
	<div class="list">
		<? foreach (@$tags as $tag) : ?>
		<div class="tag">
			<span><?= $tag->title; ?></span>
			<a title="<?= translate('Delete this tag ?') ?>" data-action="delete" data-id="<?= $tag->id; ?>" href="#"><span>[x]</span></a>
		</div>
		<? endforeach; ?>
	</div>
	<form action="<?= route('row='.@$state->row.'&table='.$state->table.'&tmpl='); ?>" method="post">
		<input type="hidden" name="row"     value="<?= $state->row?>" />
		<input type="hidden" name="table" value="<?= $state->table?>" />
		<input name="title" type="text" value="" placeholder="<?= translate('Add new tag') ?>" <?= $disabled ?> />
		<input class="button" type="submit" <?= $disabled ?> value="<?= translate('Add') ?>"/>
	</form>
	<?= translate('Seperate tags with commas'); ?>
</div>