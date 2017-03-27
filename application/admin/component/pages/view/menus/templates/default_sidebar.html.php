<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h3><?= translate('Applications') ?></h3>
<ul class="navigation">
	<? foreach($applications as $application) : ?>
	<li>
        <a <?= $state->application == $application ? 'class="active"' : '' ?> href="<?= route('application='.$application) ?>">
            <?= $application ?>
        </a>
	</li>
	<? endforeach ?>
</ul>