<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<div id="comments-comment-form">
	<form action="<?= route('row='.@$state->row.'&table='.$state->table) ?>" method="post">
        <input type="hidden" name="row" value="<?= $state->row ?>" />
        <input type="hidden" name="table" value="<?= $state->table ?>" />

        <textarea type="text" name="text" placeholder="<?= translate('Add new comment here ...') ?>" id="new-comment-text"></textarea>
        <br />
        <input class="button" type="submit" value="<?= translate('Submit') ?>"/>
    </form>
</div>