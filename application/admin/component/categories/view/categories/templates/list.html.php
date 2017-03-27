<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<ul class="navigation">
	<li>
        <a class="<?= $state->category == null ? 'active' : ''; ?>" href="<?= route('category=' ) ?>">
            <?= translate('All categories') ?>
        </a>
	</li>
	<? foreach ($categories as $category) : ?>
	<li>
        <a class="<?= $state->category == $category->id ? 'active' : ''; ?>" href="<?= route('category='.$category->id ) ?>">
            <?= escape($category->title) ?>
        </a>
	</li>
	<? endforeach ?>
</ul>