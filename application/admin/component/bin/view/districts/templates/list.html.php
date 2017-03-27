<?
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<ul class="navigation">
	<li>
        <a class="<?= $state->district == null ? 'active' : ''; ?>" href="<?= route('district=' ) ?>">
            <?= 'All districts' ?>
        </a>
	</li>
	<? foreach ($districts as $district) : ?>
	<li>
        <a class="<?= $state->district == $district->id ? 'active' : ''; ?>" href="<?= route('district='.$district->id ) ?>">
		    <?= escape($district->title) ?>
	    </a>
    </li>
    <? endforeach ?>
</ul>