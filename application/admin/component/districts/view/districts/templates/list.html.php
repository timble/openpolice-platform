<?
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
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