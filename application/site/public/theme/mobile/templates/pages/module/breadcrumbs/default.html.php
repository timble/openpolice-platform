<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
    <? foreach($list as $item) : ?>
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" onClick="ga('send', 'event', 'Breadcrumbs', 'Link', '<?=escape($item->name)?>');" href="<?= $item->link ?>">
                <span itemprop="name"><?= escape($item->name) ?></span>
                <meta itemprop="position" content="<?= array_search($item, $list) + 1 ?>" />
            </a>
        </li>
        <? // If not the last item in the breadcrumbs add the separator ?>
        <? if($item !== end($list)) : ?>
        <span class="divider">&rsaquo;</span>
        <? endif ?>
    <? endforeach ?>
</ol>