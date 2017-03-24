<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<ul class="breadcrumb">
    <? foreach($list as $key => $item) : ?>
        <? // If not the last item in the breadcrumbs add the separator ?>
        <? if($item !== end($list)) : ?>
            <? if(!empty($item->link)) : ?>
                <li><a onClick="ga('send', 'event', 'Breadcrumbs', 'Link', '<?=escape($item->name)?>');" href="<?= $item->link ?>" class="pathway"><?= escape($item->name) ?></a></li>
            <? else : ?>
                <li><?= escape($item->name) ?></li>
            <? endif ?>
            <? if($key !== count($list) - 2) : ?>
            <span class="divider">&rsaquo;</span>
            <? endif ?>
        <? endif ?>
    <? endforeach ?>
</ul>