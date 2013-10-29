<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */
?>

<title content="replace"><?= escape($params->get('page_title')); ?></title>

<div class="page-header">
    <h1><?= escape($params->get('page_title')); ?></h1>
</div>

<form action="<?= helper('route.search'); ?>" method="get" class="form-search well">
    <input type="hidden" name="forum" value="<?= $state->forum; ?>"/>
    <div class="input-append">
        <input id="searchword" name="searchword" class="input-xxlarge search-query" type="text"
               value="<?= escape($state->searchword) ?>" placeholder="<?= translate('Search all forums') ?>"/>
        <button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i></button>
    </div>
</form>

<? foreach($categories as $category): ?>
<h2><?= $category->title ?></h2>
<div class="row">
    <? foreach(object('com:fora.model.forums')->category($category->id)->getRowset() as $forum): ?>
    <div class="span4" >
        <a href="<?= helper('route.topics', array('row' => $forum)) ?>">
            <?= escape($forum->title);?>
        </a><br />
        <?= object('com:fora.model.topics')->forum($forum->id)->getTotal(); ?> <?= translate('Articles'); ?>
    </div>
    <?endforeach;?>
</div>
<? endforeach; ?>

<?= helper('paginator.pagination', array('total' => $total, 'show_limit' => false, 'show_count' => false)); ?>