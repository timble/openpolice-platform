<?
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<h3><?= translate('Categories') ?></h3>
<ul class="navigation">
    <li>
        <a class="<?= $state->category == null ? 'active' : ''; ?>" href="<?= route('category=' ) ?>">
            <?= translate('All categories') ?>
        </a>
    </li>
    <? foreach ($sections as $section) : ?>
        <h4><?= escape($section->title) ?></h4>
        <? foreach ($categories->find(array('wanted_section_id' => $section->id)) as $category) : ?>
            <li>
                <a class="<?= $state->category == $category->id ? 'active' : ''; ?>" href="<?= route('category='.$category->id ) ?>">
                    <?= escape($category->title) ?>
                </a>
            </li>
        <? endforeach ?>
    <? endforeach ?>
</ul>