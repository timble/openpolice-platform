<?
/**
 * Belgian Police Web Platform - Theme
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? if(count($languages) > '1') : ?>
<ul class="languages">
    <? foreach($languages as $language) : ?>
    <li class="languages__item">
        <? if($language->iso_code != $active->iso_code) : ?>
        <a href="?language=<?= $language->slug ?>"><?= $language->slug ?></a>
        <? else : ?>
        <?= $language->slug ?>
        <? endif ?>
    </li>
    <? endforeach ?>
</ul>
<? endif ?>
