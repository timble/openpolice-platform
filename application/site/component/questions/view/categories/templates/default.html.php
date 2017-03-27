<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<? if(!$state->category) : ?>
    <?= import('com:questions.view.questions.default_search.html') ?>
<? endif ?>

<ul class="nav nav--pills column--triple">
    <? foreach ($categories as $category): ?>
        <li>
            <a href="<?= helper('route.category', array('row' => $category)) ?>">
                <?= $category->title ?>
            </a>
        </li>
    <? endforeach ?>
</ul>

<? if($zone->id != '5396') : ?>
    <?= import('com:questions.view.questions.default_contact.html') ?>
<? endif ?>
