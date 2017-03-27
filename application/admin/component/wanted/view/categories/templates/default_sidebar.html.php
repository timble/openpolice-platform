<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h3><?= translate('Sections') ?></h3>
<ul class="navigation">
    <li>
        <a class="<?= $state->section == null ? 'active' : ''; ?>" href="<?= route('section=' ) ?>">
            <?= translate('All sections') ?>
        </a>
    </li>
    <? foreach ($sections as $section) : ?>
    <li>
        <a class="<?= $state->section == $section->id ? 'active' : ''; ?>" href="<?= route('section='.$section->id ) ?>">
            <?= escape($section->title) ?>
        </a>
    </li>
    <? endforeach ?>
</ul>