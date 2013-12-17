<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<style src="assets://fora/css/default.css" />

<div id="com_fora" class="scrollable">

    <div id="fora-categories-default">
        <div class="well well-small">
            <form action="<?= route('view=topics&layout=search') ?>" method="get" name="search">
                <input name="search" type="text" placeholder="<?= translate('Search all categories...') ?>" autofocus="autofocus" />
                <input class="btn primary" type="submit" value="Search" disabled="disabled" />
            </form>
        </div>
        <div class="well well-small">
            <ul class="breadcrumb">
                <? foreach($pathways as $item) : ?>
                    <? // If not the last item in the breadcrumbs add the separator ?>
                    <? if($item !== end($pathways)) : ?>
                        <? if(!empty($item->link)) : ?>
                            <li><a href="<?= $item->link ?>" class="pathway"><?= escape($item->name) ?></a></li>
                        <? else : ?>
                            <li><?= escape($item->name) ?></li>
                        <? endif ?>
                        <span class="divider">&rsaquo;</span>
                    <? else : ?>
                        <li><?= escape($item->name) ?></li>
                    <? endif ?>
                <? endforeach ?>
            </ul>
        </div>

        <div class="well well-small">
            <div class="well__frame">
                <h1 class="well__heading well__heading--left">
                    <a href="<?= route('view=category&id='.$category->id.'&slug='.$category->slug) ?>">
                        <?= escape($category->title) ?>
                    </a>
                </h1>
            </div>
            <div class="well__content">
                <?= import('default_items.html',
                    array('category' => $category, 'forums' => $forums, 'topics' => $topics, 'topics_count' => $topics_count)); ?>
            </div>
        </div>

    </div>
</div>